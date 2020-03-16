<template>
    <div class="container">
        <div class="row justify-content-center" v-for="(post, index) in posts">
            <div class="col-md-6 mb-2">
                <div class="card">
                    <div class="card-header"><strong>{{post.user.name}} {{post.id}}</strong></div>

                    <div class="card-body"
                         :style="'background-image:url(' + image(post.image) + ')'">

                    </div>

                    <div class="card-footer">

                        <div v-for="comment in post.comments">
                            <div><em><small>{{ relativeDate(comment.created_at) }}</small></em></div>
                            <div class="mb-2">
                                <strong>{{ comment.user.name }}</strong> <p>{{ comment.body }}</p>
                            </div>
                        </div>

                        <div v-if="loggedIn">
                            <form>

                                <input type="hidden" name="post_id" value="{{}}">
                                <textarea name="body" id="body" class="form-control"
                                          placeholder="My comment..." v-model:value="comment[index]"></textarea>
                                <button type="button" class="btn btn-primary" @click="submitComment(post.id, index)">
                                    Send</button>
                            </form>
                        </div>
                        <div class="text-primary">
                            <span v-for="tag in post.tags">#{{ tag.title }}&nbsp;</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props: ['dataPosts', 'dataUser'],
        data() {
            return {
                posts: [],
                loggedIn: false,
                user: [],
                comment:[],

            }
        },

        mounted() {
            this.posts = JSON.parse(this.dataPosts);
            this.user = JSON.parse(this.dataUser);
            if (this.user) this.loggedIn = true;
        },
        methods: {
            image(im) {
                return (im.indexOf('http') < 0) ? 'storage/' + im : im;
            },

            relativeDate(dt) {
                return moment(dt).fromNow();
            },
            getPosts() {
                axios.get('/api/posts')
                    .then((response) => {
                        this.posts = response.data;
                    })
            },
            submitComment(id, index) {
                axios.post('/api/comments', {
                    body: this.comment[index],
                    post_id: id,
                    user_id: this.user.id,
                    index: index
                })
                    .then((response) => {
                        this.posts[response.data.index].comments.unshift(response.data.comment);
                        this.comment = [];
                    })
            }
        }
    }
</script>
