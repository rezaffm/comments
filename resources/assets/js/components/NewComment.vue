<template>
    <div class="mb-5">
        <a
            v-if="!active"
            href="#"
            class="btn btn-primary btn-block"
            @click.prevent="active = !active"
        >Post a comment</a>
        <template v-if="active">
            <form @submit.prevent="">
                <div class="form-group">
                    <textarea
                        id="body"
                        rows="10"
                        class="form-control"
                        autofocus="autofocus"
                        v-model="form.body"
                    ></textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary" @click.prevent="store">Post</button>
                    <a href="#" class="btn btn-link" @click.prevent="active = false">Cancel</a>
                </div>
            </form>
        </template>
    </div>
</template>

<script>
    import bus from '../bus';

    export default {
        data() {
            return {
                active: false,
                form: {
                    body: ''
                }
            }
        },
        props: {
            endpoint: {
                type: String,
                required: true
            }
        },
        methods: {
            async store() {
                let comment = await axios.post(this.endpoint, this.form)

                bus.$emit('comment:stored', comment.data.data)

                this.active = false;
                this.form.body = ''
            }
        }
    }
</script>





