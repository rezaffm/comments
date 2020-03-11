<template>
    <div>
        <form @submit.prevent="patch" id="reply">
            <div class="form-group">
                {{ textareaHeight }}
                <textarea
                    id="body"
                    :rows="textareaHeight"
                    class="form-control"
                    autofocus="autofocus"
                    v-model="form.body"
                ></textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Edit</button>
                <a href="#" @click.prevent="cancel" class="btn btn-link">Cancel</a>
            </div>
        </form>
    </div>
</template>

<script>
    import axios from 'axios'
    import bus from '../bus'

    export default {
        data() {
            return {
                form: {
                    body: this.comment.body
                }
            }
        },
        props: {
            comment: {
                required: true,
                type: Object
            }
        },
        computed: {
            textareaHeight () {
                return Math.max(Math.floor(this.comment.body.split(/\r*\n/).length / 2), 6)
            }
        },
        methods: {
            async patch() {
                let comment = await axios.patch(`/comments/${this.comment.id}`, this.form)

                bus.$emit('comment:editing', comment.data.data)

                this.cancel()
            },
            cancel() {
                bus.$emit('comment:edit-cancelled', this.comment)
            }
        }
    }
</script>





