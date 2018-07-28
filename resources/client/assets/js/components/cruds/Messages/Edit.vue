<template>
    <section class="content-wrapper" style="min-height: 960px;">
        <section class="content-header">
            <h1>Μηνύματα</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <form @submit.prevent="submitForm" novalidate>
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Edit</h3>
                            </div>

                            <div class="box-body">
                                <back-buttton></back-buttton>
                            </div>

                            <bootstrap-alert />

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="paper">Paper</label>
                                    <v-select
                                            name="paper"
                                            label="title"
                                            @input="updatePaper"
                                            :value="item.paper"
                                            :options="papersAll"
                                            />
                                </div>
                                <div class="form-group">
                                    <label for="address">Address *</label>
                                    <input
                                            type="email"
                                            class="form-control"
                                            name="address"
                                            placeholder="Enter Address *"
                                            :value="item.address"
                                            @input="updateAddress"
                                            >
                                </div>
                                <div class="form-group">
                                    <label for="name">Name *</label>
                                    <input
                                            type="text"
                                            class="form-control"
                                            name="name"
                                            placeholder="Enter Name *"
                                            :value="item.name"
                                            @input="updateName"
                                            >
                                </div>
                                <div class="form-group">
                                    <label for="body">Body *</label>
                                    <vue-ckeditor
                                            name="body"
                                            :id="'body'"
                                            :value="item.body"
                                            @input="updateBody"
                                    />
                                </div>
                            </div>

                            <div class="box-footer">
                                <vue-button-spinner
                                        class="btn btn-primary btn-sm"
                                        :isLoading="loading"
                                        :disabled="loading"
                                        >
                                    Save
                                </vue-button-spinner>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </section>
</template>


<script>
import { mapGetters, mapActions } from 'vuex'

export default {
    data() {
        return {
            // Code...
        }
    },
    computed: {
        ...mapGetters('MessagesSingle', ['item', 'loading', 'papersAll']),
    },
    created() {
        this.fetchData(this.$route.params.id)
    },
    destroyed() {
        this.resetState()
    },
    watch: {
        "$route.params.id": function() {
            this.resetState()
            this.fetchData(this.$route.params.id)
        }
    },
    methods: {
        ...mapActions('MessagesSingle', ['fetchData', 'updateData', 'resetState', 'setPaper', 'setAddress', 'setName', 'setBody']),
        updatePaper(value) {
            this.setPaper(value)
        },
        updateAddress(e) {
            this.setAddress(e.target.value)
        },
        updateName(e) {
            this.setName(e.target.value)
        },
        updateBody(value) {
            this.setBody(value)
        },
        submitForm() {
            this.updateData()
                .then(() => {
                    this.$router.push({ name: 'messages.index' })
                    this.$eventHub.$emit('update-success')
                })
                .catch((error) => {
                    console.error(error)
                })
        }
    }
}
</script>


<style scoped>

</style>
