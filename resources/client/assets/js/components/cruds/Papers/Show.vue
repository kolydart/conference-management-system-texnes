<template>
    <section class="content-wrapper" style="min-height: 960px;">
        <section class="content-header">
            <h1>Προτάσεις</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">View</h3>
                        </div>

                        <div class="box-body">
                            <back-buttton></back-buttton>
                        </div>

                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-6">
                                    <table class="table table-bordered table-striped">
                                        <tbody>
                                        <tr>
                                            <th>#</th>
                                            <td>{{ item.id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Τίτλος</th>
                                            <td>{{ item.title }}</td>
                                            </tr>
                                        <tr>
                                            <th>Τέχνη</th>
                                            <td>
                                                <span class="label label-info" v-for="art in item.art">
                                                    {{ art.name }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Τύπος</th>
                                            <td>{{ item.type }}</td>
                                            </tr>
                                        <tr>
                                            <th>Διάρκεια</th>
                                            <td>{{ item.duration }}</td>
                                            </tr>
                                        <tr>
                                            <th>Ονοματεπώνυμο</th>
                                            <td>{{ item.name }}</td>
                                            </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ item.email }}</td>
                                            </tr>
                                        <tr>
                                            <th>Ιδιότητα</th>
                                            <td>{{ item.attribute }}</td>
                                            </tr>
                                        <tr>
                                            <th>Αρχείο</th>
                                            <td v-html="item.document_link"></td>
                                            </tr>
                                        <tr>
                                            <th>Ανάθεση</th>
                                            <td>
                                                <span class="label label-info" v-for="assign in item.assign">
                                                    {{ assign.name }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>{{ item.status }}</td>
                                            </tr>
                                        <tr>
                                            <th>Informed</th>
                                            <td>{{ item.informed }}</td>
                                            </tr>
                                        <tr>
                                            <th>Reviews</th>
                                            <td>
                                                <span class="label label-info" v-if="item.reviews !== null">
                                                    {{ item.reviews.judgement }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Messages</th>
                                            <td>
                                                <span class="label label-info" v-if="item.messages !== null">
                                                    {{ item.messages.body }}
                                                </span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
    created() {
        this.fetchData(this.$route.params.id)
    },
    destroyed() {
        this.resetState()
    },
    computed: {
        ...mapGetters('PapersSingle', ['item'])
    },
    watch: {
        "$route.params.id": function() {
            this.resetState()
            this.fetchData(this.$route.params.id)
        }
    },
    methods: {
        ...mapActions('PapersSingle', ['fetchData', 'resetState'])
    }
}
</script>


<style scoped>

</style>
