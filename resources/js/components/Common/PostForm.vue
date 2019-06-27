<template>
    <div>


        <div class="post-header" :style="`background-image: url(../uploads/${post.image})`">
        </div>

        <!-- Page Content -->
        <div class="container">

            <div class="row">

                <!-- Blog Entries Column -->
                <div class="col-md-8 mb-4">
                    <!-- Blog Post -->
                    <h2>{{post.title}}</h2>
                    <p class="post-content">{{post.content}}</p>
                    <div class="post-footer text-muted">
                        Posted on {{ post.created_at | moment("dddd, MMMM Do YYYY, h:mm:ss a") }} by
                        <a href="#">{{ post.author.name }}</a>
                    </div>

                    <div class="related">
                        <h4>You may also be interested on:</h4>
                        <ul>
                            <li v-for="related_post in related_posts"><a :href="`/posts/${related_post._id}`">{{related_post.title}}</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Sidebar Widgets Column -->
                <div class="col-md-4">

                    <!-- Search Widget -->
                    <div class="card mb-4">
                        <h5 class="card-header">Search</h5>
                        <div class="card-body">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for...">
                                <span class="input-group-btn">
                                    <button class="btn btn-secondary" type="button">Go!</button>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Categories Widget -->
                    <div class="card my-4">
                        <h5 class="card-header">Categories</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <ul class="list-unstyled mb-0">
                                        <li>
                                            <a href="#">Web Design</a>
                                        </li>
                                        <li>
                                            <a href="#">HTML</a>
                                        </li>
                                        <li>
                                            <a href="#">Freebies</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <ul class="list-unstyled mb-0">
                                        <li>
                                            <a href="#">JavaScript</a>
                                        </li>
                                        <li>
                                            <a href="#">CSS</a>
                                        </li>
                                        <li>
                                            <a href="#">Tutorials</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Side Widget -->
                    <div class="card my-4">
                        <h5 class="card-header">Side Widget</h5>
                        <div class="card-body">
                            You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
                        </div>
                    </div>

                </div>

            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->


    </div>
</template>

<script>

    export default {
        components: {
        },
        props: {
            post : {
                default: {},
                type: Object
            },
            related_posts : {
                default: [],
                type: Array
            }
        },
        data() {
            return {
                loading: false,
            }
        },
        methods: {
        }
    }
</script>

