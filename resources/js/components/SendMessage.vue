<template>
    <div>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#chat">Parler maintenant</button>

        <!-- Modal -->
        <div class="modal fade" id="chat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fs-5" id="exampleModalLabel">
                            Communiquer avec {{ receiverid }} {{ receivername }}
                        </h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form @submit.prevent="sendMsg()">
                        <div class="modal-body">
                            <div class="form-group">
                                <textarea class="form-control" v-model="form.msg" id="" rows="3" placeholder="Saisissez votre message..."></textarea>

                                <span class="text-success" v-if="succMessage.message">
                                    {{ succMessage.message }}
                                </span>

                                <span class="text-danger" v-if="errors.msg">
                                    {{ errors.msg[0] }}
                                </span>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
</template>


<script>
    export default {
        props: ['receiverid', 'receivername'],

        data() {
            return {
                form: {
                    msg: "",
                    receiver_id: this.receiverid,
                },
                errors: {},
                succMessage: {},
            }
        },

        methods: {
            sendMsg() {
                // alert(this.form.msg)
                axios.post('/send-message', this.form)
                .then((res) => {
                    this.form.msg = '',
                    this.succMessage = res.data;
                    // console.log(res.data);
                }).catch((err) => {
                    this.errors = err.response.data.errors;
                })
            }
        }
    }
</script>

