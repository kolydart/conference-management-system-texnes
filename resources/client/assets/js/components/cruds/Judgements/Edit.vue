<template>
    <section class="content-wrapper" style="min-height: 960px;">
        <section class="content-header">
            <h1>Κρίσεις</h1>
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
                                    <label for="paper">Paper *</label>
                                    <v-select
                                            name="paper"
                                            label="title"
                                            @input="updatePaper"
                                            :value="item.paper"
                                            :options="papersAll"
                                            />
                                </div>
                                <div class="form-group">
                                    <label for="judgement">Judgement *</label>
                                    <div class="radio">
                                        <label>
                                            <input
                                                    type="radio"
                                                    name="judgement"
                                                    :value="item.judgement"
                                                    :checked="item.judgement === 'Approve'"
                                                    @change="updateJudgement('Approve')"
                                                    >
                                            Approve
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input
                                                    type="radio"
                                                    name="judgement"
                                                    :value="item.judgement"
                                                    :checked="item.judgement === 'Neutral'"
                                                    @change="updateJudgement('Neutral')"
                                                    >
                                            Neutral
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input
                                                    type="radio"
                                                    name="judgement"
                                                    :value="item.judgement"
                                                    :checked="item.judgement === 'Reject'"
                                                    @change="updateJudgement('Reject')"
                                                    >
                                            Reject
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="comment">Comment</label>
                                    <textarea
                                            rows="3"
                                            class="form-control"
                                            name="comment"
                                            placeholder="Enter Comment"
                                            :value="item.comment"
                                            @input="updateComment"
                                            >
                                    </textarea>
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
        ...mapGetters('JudgementsSingle', ['item', 'loading', 'papersAll', 'usersAll']),
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
        ...mapActions('JudgementsSingle', ['fetchData', 'updateData', 'resetState', 'setPaper', 'setJudgement', 'setComment', 'setUser']),
        updatePaper(value) {
            this.setPaper(value)
        },
        updateJudgement(value) {
            this.setJudgement(value)
        },
        updateComment(e) {
            this.setComment(e.target.value)
        },
        submitForm() {
            this.updateData()
                .then(() => {
                    this.$router.push({ name: 'judgements.index' })
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
