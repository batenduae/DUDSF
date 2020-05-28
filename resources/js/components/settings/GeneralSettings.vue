<template>
    <div class="tile">
<!--        {{ route('admin.settings.update') }}-->
        <form action="" method="POST" role="form">
            <h3 class="tile-title">General Settings</h3>
            <hr>
            <div class="tile-body">
                <div class="form-group" v-for="setting in settings" v-if="setting.key=='site_name'">
                    <label class="control-label" for="site_name">Site Name</label>
                    <input
                        class="form-control"
                        type="text"
                        placeholder="Enter site name"
                        :value="setting.name"
                        id="site_name"
                        name="site_name"
                        v-model="site_name"

                    />
                </div>
                <div class="form-group" v-for="setting in settings" v-if="setting.key=='site_title'">
                    <label class="control-label" for="site_title">Site Title</label>
                    <input
                        class="form-control"
                        type="text"
                        placeholder="Enter site title"
                        id="site_title"
                        name="site_title"
                        :value="setting.value"
                    />
                </div>
                <div class="form-group" v-for="setting in settings" v-if="setting.key=='default_email_address'">
                    <label class="control-label" for="default_email_address">Default Email Address</label>
                    <input
                        class="form-control"
                        type="email"
                        placeholder="Enter store default email address"
                        id="default_email_address"
                        name="default_email_address"
                        :value="setting.value"
                    />
                </div>
                <div class="form-group" v-for="setting in settings" v-if="setting.key=='currency_code'">
                    <label class="control-label" for="currency_code">Currency Code</label>
                    <input
                        class="form-control"
                        type="text"
                        placeholder="Enter store currency code"
                        id="currency_code"
                        name="currency_code"
                        :value="setting.value"
                    />
                </div>
                <div class="form-group" v-for="setting in settings" v-if="setting.key=='currency_symbol'">
                    <label class="control-label" for="currency_symbol">Currency Symbol</label>
                    <input
                        class="form-control"
                        type="text"
                        placeholder="Enter store currency symbol"
                        id="currency_symbol"
                        name="currency_symbol"
                        :value="setting.value"
                    />
                </div>
            </div>
            <div class="tile-footer">
                <div class="row d-print-none mt-2">
                    <div class="col-12 text-right">
                        <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Settings</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</template>

<script>
    export default {
        name: "general-settings-component",
        data() {
            return {
                settings: [],
                site_name: '',
                site_title: '',
            }
        },
        created: function () {
            this.loadSettings();
        },
        methods: {
            loadSettings(){
                let _this = this;
                axios.post('/admin/settings/main',{
                    type: 'get'
                }).then(function (response) {
                    _this.settings = response.data[0];
                }).catch(function (error) {
                    console.log(error)
                });
            },
        }
    }
</script>

<style scoped>

</style>
