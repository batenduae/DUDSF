<template>
    <template>
        <button :class="classes" @click="click(data)" title="Update">
        <span>
            <i class="fa fa-eye" aria-hidden="true"></i>
        </span>
            &nbsp;
            {{ name }}
        </button>
</template>

<script>
    export default {
        name: "data-table",
        props: {
            data: {},
            name: {},
            click: {},
            classes: {},
        },
        data() {
            return {
                perPage: ['10', '25', '50','100','200'],
                columns: [
                    {
                        label: 'ID',
                        name: 'id',
                        filterable: true,
                    },
                    {
                        label: 'Name',
                        name: 'name',
                        filterable: true,
                    },
                    {
                        label: 'Email',
                        name: 'email',
                        filterable: true,
                    },
                    {
                        label: '',
                        name: 'View',
                        filterable: false,
                    },
                ],
                "table-container": {
                    "table-responsive": true,
                },
                "table": {
                    "table": true,
                    "table-striped": true,
                    "table-dark": true,
                },
                "t-head": {

                },
                "t-body": {

                },
                "t-head-tr": {

                },
                "t-body-tr": {

                },
                "td": {

                },
                "th": {

                },
            }
        },
    }
</script>

<style scoped>

</style>
