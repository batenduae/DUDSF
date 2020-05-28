<template>
<div>
    <div class="tile">
        <h3 class="tile-title">Settings</h3>
        <hr>
        <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="key">Key</label>
                            <input
                                class="form-control"
                                type="text"
                                placeholder="Enter setting key"
                                id="key"
                                name="key"
                                v-model="key"
                            />
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="value">Value</label>
                            <input
                                class="form-control"
                                type="text"
                                placeholder="Enter setting value"
                                id="value"
                                name="value"
                                v-model="value"
                            />
                        </div>
                    </div>
                    <div class="tile-footer">
                        <div class="row d-print-none mt-2">
                            <div class="col-12 text-right">
                                <button class="btn btn-success" type="submit" @click.stop="saveSetting()" v-if="addSetting">
                                    <i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                                </button>
                                <button class="btn btn-success" type="submit" @click.stop="updateSetting()" v-if="!addSetting">
                                    <i class="fa fa-fw fa-lg fa-check-circle"></i>Update
                                </button>
                                <button class="btn btn-primary" type="submit" @click.stop="reset()" v-if="!addSetting">
                                    <i class="fa fa-fw fa-lg fa-check-circle"></i>Reset
                                </button>
                            </div>
                        </div>
        </div>
    </div>
    <div id="">
        <div class="tile">
            <h3 class="tile-title">Option Values</h3>
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-striped text-center">
                        <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Key</th>
                            <th>Value</th>
                            <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="setting in settings">
                            <td style="width: 25%" class="text-center">{{ setting.id}}</td>
                            <td style="width: 25%" class="text-center">{{ setting.key}}</td>
                            <td style="width: 25%" class="text-center">{{ setting.value}}</td>
                            <td style="width: 25%" class="text-center">
                                <button class="btn btn-sm btn-primary" @click.stop="editSetting(setting)">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" @click.stop="deleteSetting(setting)" v-if=" setting.key!= 'memberMaxImage'">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        name: "other-settings-component",
        data() {
            return {
                settings: [],
                addSetting: true,
                currentId: '',
                key: '',
                value: '',
                url: 'http://vue-datatable.test/ajax',
                perPage: ['10', '25', '50'],
                columns: [
                    {
                        label: 'ID',
                        name: 'id',
                        filterable: true,
                    },
                    {
                        label: 'Key',
                        name: 'key',
                        filterable: true,
                    },
                    {
                        label: 'Value',
                        name: 'value',
                        filterable: true,
                    },
                    {
                        label: '',
                        name: 'action',
                        filterable: false,
                    },
                ],
            }
        },
        created: function () {
            this.loadSettings();
        },
        mounted() {
            let externalScript = document.createElement('script')
            externalScript.setAttribute('src', '')
            document.head.appendChild(externalScript)
        },
        methods: {
            loadSettings() {
                let _this = this;
                axios.post('/admin/settings/vue',{
                    type: 'get',
                })
                .then(function (response) {
                    _this.settings = response.data;
                }).catch(function (error) {
                    console.log(error);
                })
            },
            saveSetting() {
                let _this = this;
                if(this.key === '') {
                    this.$swal("Error, key for setting is required.",{
                        icon: "error",
                    });
                }else {
                    let _this = this;
                    axios.post('/admin/settings/vue',{
                        type: 'add',
                        key: _this.key,
                        value: _this.value,
                    }).then(function (response) {
                        _this.settings.push(response.data);
                        _this.resetValue();
                        _this.$swal("Success! Setting added successfully!",{
                            icon: "success",
                        });
                    }).catch(function (error) {
                        console.log(error);
                    })
                }
            },
            editSetting(setting) {
                this.addSetting = false;
                this.currentId = setting.id;
                this.key = setting.key;
                this.value = setting.value;
                this.index = this.settings.indexOf(setting);
            },
            updateSetting() {
                if(this.key === '') {
                    this.$swal("Error, key for setting is required.",{
                        icon: "error",
                    });
                }else {
                    let _this = this;
                    axios.post('/admin/settings/vue',{
                        type: 'update',
                        id: _this.currentId,
                        key: _this.key,
                        value: _this.value,
                    }).then(function (response) {
                        _this.settings.splice(_this.index,1);
                        _this.resetValue();
                        _this.settings.push(response.data);
                        _this.$swal("Success! Setting updated successfully!",{
                            icon: "success",
                        });
                    }).catch(function (error) {
                        console.log(error);
                    })
                }
            },
            deleteSetting(setting) {
                this.$swal({
                    title: "Are you sure?",
                    text: "Once deleted, can not be restored!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if(willDelete) {
                        this.currentId = setting.id;
                        this.index = this.settings.indexOf(setting);
                        let _this = this;
                        axios.post('/admin/settings/vue',{
                            type: 'delete',
                            id: _this.currentId,
                        }).then( function (response) {
                            if(response.data.status === 'success') {
                                _this.settings.splice(_this.index,1);
                                _this.resetValue();
                                _this.$swal("Success!, Setting deleted successfully", {
                                    icon: 'success',
                                });
                            } else {
                                _this.$swal("Setting not deleted");
                            }
                        }).catch(function (error) {
                            console.log(error);
                        });
                    }else {
                        this.$swal("Setting not deleted");
                    }
                });
            },
            resetValue() {
                this.key = '';
                this.value = '';
            },
            reset() {
                this.addSetting = true;
                this.resetValue();
            }
        }
    }
</script>

<style scoped>
    /*.stripped-table:nth-child(even) {*/
    /*    @apply bg-black;*/
    /*}*/
</style>
