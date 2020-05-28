<template>
    <button class="btn btn-success" type="submit" @click.stop="sendMails()">
        <i class="fa fa-fw fa-lg fa-check-circle"></i>Send Mail via Vue
    </button>
</template>

<script>
    export default {
        name: "mail-component",
        methods: {
            sendMails() {
                this.$swal({
                    title: "Confirm Entry",
                    text: "Are you sure all entries are correct",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#6A9944",
                    confirmButtonText: "Confirm",
                    cancelButtonText: "Cancel",
                    closeOnConfirm: true
                }).then((isConfirm) => {
                    if(isConfirm) {
                        let _this = this;
                        axios.post('/admin/members/sendLoginIdMailAllVue',{
                        }).then( function (response) {
                            if(response.data.status === 'success') {
                                _this.$swal("Success!, Email send to All", {
                                    icon: 'success',
                                });
                            } else {
                                _this.$swal("Email not send");
                            }
                        }).catch(function (error) {
                            console.log(error);
                        });
                    }else {
                        this.$swal("Email not send");
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>
