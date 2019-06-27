<template>
    <div>
        <HomeSlider></HomeSlider>

        <!-- Page Content -->
        <div class="container">

            <div class="row">

                <!-- Blog Entries Column -->
                <div class="col-md-8 mb-4">

                    <!-- Blog Post -->
                    <div class="card mb-4" v-for="post in blog.posts">
                        <img class="card-img-top" :src="`../uploads/${post.image}`" alt="Card image cap">
                        <div class="card-body">
                            <h2 class="card-title"><a :href="`/posts/${post.slug}`">{{post.title}}</a></h2>
                            <p class="card-text">{{brief(post.content)}}</p>
                            <a :href="`/posts/${post.slug}`" class="btn btn-primary">Read More &rarr;</a>
                        </div>
                        <div class="card-footer text-muted">
                            Posted on {{ post.created_at | moment("dddd, MMMM Do YYYY, h:mm:ss a") }} by
                            <a href="#">{{ post.author.name }}</a>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="load-more" @click="loadMore">
                        Load More Articles
                        <span v-if="loading">
                            <b-spinner small></b-spinner>
                        </span>
                    </div>

                </div>

                <!-- Sidebar Widgets Column -->
                <div class="col-md-4">

                    <search></search>

                    <categories></categories>

                    <widget></widget>

                </div>

            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->
    </div>
</template>

<script>
    import HomeSlider from './../Common/HomeSlider'
    import search from './../Common/Search'
    import categories from './../Common/Categories'
    import widget from './../Common/Widget'
    import { mapState } from 'vuex';

    export default {
        components: {
            HomeSlider,
            search,
            categories,
            widget
        },
        data() {
            return {
                //posts: [],
                page: 1,
                loading: false,
            }
        },
        mounted() {
            console.log('Home Mounted');
        },
        created(){
            this.$store.dispatch('loadPosts', 1);
        },
        computed: {
            ...mapState(['blog']),
        },
        methods: {
            loadMore(){
                this.loading = true;
                this.page++;
                this.$store.dispatch('loadPosts', this.page).then(res => {
                    this.loading = false;
                });
            },
            brief(content){
                return content.substr(0,144) + '...';
            }
        }
    }
</script>

