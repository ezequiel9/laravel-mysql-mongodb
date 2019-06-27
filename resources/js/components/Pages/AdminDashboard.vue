<template>
    <div>
        <div class="container">
            <h1 class="page-title">Admin Dashboard</h1>
        </div>

        <div class="dashboard container">
            <!--Inner Dashboard-->
            <div class="dashboard-content">
                <!--Form Post-->
                <form action="" @submit.prevent="onSubmit()" enctype="multipart/form-data">
                    <b-form-group
                        description="Please choose a title to your post"
                        label="Title*"
                        label-for="title"
                    >
                        <b-form-input id="title" v-model="post.title" trim></b-form-input>
                    </b-form-group>

                    <b-form-group
                        description="Let us know your name."
                        label="Subtitle"
                        label-for="subtitle"
                    >
                        <b-form-input id="subtitle" v-model="post.subtitle" trim></b-form-input>
                    </b-form-group>

                    <div class="row">
                        <div class="col-md-6">
                            <b-form-group
                                description="Upload an image."
                                label="Featured Image"
                                label-for="image"
                            >
                                <!-- Styled -->
                                <b-form-file
                                    id="image"
                                    accept="image/*"
                                    v-bind:v-model="post.image"
                                    placeholder="Choose a file..."
                                    v-on:change="onImageChange"
                                    drop-placeholder="Drop file here..."
                                ></b-form-file>
                                <div class="mt-3">Selected file: {{ post.image ? post.image.name : '' }}</div>
                            </b-form-group>
                        </div>
                        <div class="col-md-6">
                            <img :src="`${preview}`" alt="" class="img-fluid" v-if="post.image">
                        </div>
                    </div>

                    <b-form-group
                        description="Minimum 100 characters."
                        label="Content*"
                        label-for="content"
                    >
                        <b-form-textarea
                            id="content"
                            v-model="post.content"
                            placeholder="Enter something..."
                            rows="6"
                            max-rows="200"
                        ></b-form-textarea>
                    </b-form-group>

                    <b-button variant="primary" type="submit">
                        Publish Post
                        <span v-if="loading">
                            <b-spinner small></b-spinner>
                        </span>
                    </b-button>
                </form>
            </div>
            <!--Sidebar-->
            <div class="sidebar">
                <div class="card mb-4">
                    <h5 class="card-header">Account Details</h5>
                    <div class="card-body">
                        <p>Email: {{user.email}}</p>
                        <p>Name: {{user.name}}</p>
                        <p>Password: ******</p>
                        <p>Role: {{user.role}}</p>
                        <p>Member Since: {{ user.created_at | moment("dddd, MMMM Do YYYY, h:mm:ss") }}</p>
                    </div>
                </div>
                <div class="card mb-4">
                    <h5 class="card-header">My Posts</h5>
                    <div class="card-body">
                        <ul>
                            <li v-for="post in user.posts">
                                {{post.title}} |
                                <a href="#" @click="editPost(post)">Edit</a> |
                                <a href="#" @click="deletePost(post)">Delete</a> |
                                <a :href="`/posts/${post.slug}`">View</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "admin-dashboard",
        props: {
            user: {
                default: {},
                type: Object
            }
        },
        data(){
            return {
                post: {
                    title: '',
                    subtitle: '',
                    content: '',
                    image: '',
                },
                edit: false,
                preview: '',
                loading: false,
            }
        },
        computed: {
            titleState(){
                return this.post.title.length >= 4 ? true : false
            },
        },
        methods: {
            onSubmit(){
                if(this.validatePost()){
                    this.loading = true;
                    if(this.edit){
                        axios.patch(route('posts.update', {post: this.post._id} ).url(), this.post )
                            .then((response) => {
                                this.loading = false;
                                alertify.success('Post updated Successfully.');
                                window.location.reload();
                            })
                            .catch(function (error) {
                                alertify.alert('sorry, we could not save your post. please try again');
                                this.loading = false;
                            });
                    }else{
                        axios.post(route('posts.store'), this.post)
                            .then((response) => {
                                this.loading = false;
                                alertify.success('Post saved Successfully.');
                                window.location.reload();
                            })
                            .catch(function (error) {
                                alertify.alert('sorry, we could not save your post. please try again');
                                this.loading = false;
                            })
                    }
                }

            },
            editPost(post){
                if(this.titleState){
                    alertify.confirm("Do you want to discard the changes done on this post?",
                        function(){
                            this.post = post;
                            this.edit = true;
                            this.preview = '/uploads/'+this.post.image;
                        }
                    );
                }else{
                    this.post = post;
                    this.edit = true
                    this.preview = '/uploads/'+this.post.image;
                }
            },
            deletePost(post){

                alertify.confirm("Do you want to delete this post?",
                    function(){
                        axios.delete(route('posts.destroy', {post: post._id} ).url())
                            .then((response) => {
                                this.loading = false;
                                alertify.success('Post deleted Successfully.');
                                window.location.reload();
                            })
                            .catch(function (error) {
                                alertify.alert('sorry, we could not save your post. please try again');
                                this.loading = false;
                            })
                    }
                );
            },
            onImageChange(e){
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.preview = URL.createObjectURL(e.target.files[0]);
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this.post;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            validatePost(){
                let post = this.post;
                if(post.title.length < 10){
                    alertify.alert('Please choose a title a little bit longer');
                    return false;
                }
                if(post.image.length <= 0){
                    alertify.alert('Please choose an image');
                    return false;
                }
                if(post.content.length < 100){
                    alertify.alert('The minimum length for the content is 100 characters');
                    return false;
                }
                return true;
            }
        }

    }
</script>
