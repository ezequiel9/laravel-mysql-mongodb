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
                    <h1 class="title">{{post.title}}</h1>
                    <p class="post-content">{{post.content}}</p>
                    <div class="post-footer text-muted">
                        Posted on {{ post.created_at | moment("dddd, MMMM Do YYYY, h:mm:ss a") }} by
                        <a href="#">{{ post.author.name }}</a>
                    </div>

                    <div class="related">
                        <h4>You may also be interested on:</h4>
                        <ul>
                            <li v-for="related_post in related_posts"><a :href="`/posts/${related_post.slug}`">{{related_post.title}}</a></li>
                        </ul>
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

    import search from './../Common/Search'
    import categories from './../Common/Categories'
    import widget from './../Common/Widget'

    export default {
        components: {
            search,
            categories,
            widget
        },
        props: {
            post : {
                default: {},
                type: Object
            },
            related_posts : {
                default: [],
                type: Array
            },
            user : {
                default: null,
                type: Object
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

