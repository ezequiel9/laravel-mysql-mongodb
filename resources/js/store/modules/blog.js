export default {
    // we could set up states to manage our app like this...
    // I have applied this states on Home.vue components only.
    // where you can see an example.
    state: {
        posts: [],
    },

    getters: {
        getPosts(){
            return state.posts;
        }
    },

    actions: {
        loadPosts({ commit }, page = 1){
            axios.get(route('posts.index'), {params: { page : page } } )
                .then((response) => {
                    let data = response.data.data;
                    //console.log(data);
                    commit('setPosts', data);
                }).catch(err => (console.log(err)));
        }
    },

    mutations: {
        setPosts(state, posts){
            //console.log(posts);
            state.posts = [...state.posts, ...posts];
        }
    },
};
