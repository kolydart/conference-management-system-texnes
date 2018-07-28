<template>
    <section class="content-wrapper" style="min-height: 960px;">
        <section class="content-header">
            <h1>Προτάσεις</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <form @submit.prevent="submitForm" novalidate>
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Create</h3>
                            </div>

                            <div class="box-body">
                                <back-buttton></back-buttton>
                            </div>

                            <bootstrap-alert />

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="title">Τίτλος</label>
                                    <input
                                            type="text"
                                            class="form-control"
                                            name="title"
                                            placeholder="Enter Τίτλος"
                                            :value="item.title"
                                            @input="updateTitle"
                                            >
                                </div>
                                <div class="form-group">
                                    <label for="art">Τέχνη</label>
                                    <v-select
                                            name="art"
                                            label="title"
                                            @input="updateArt"
                                            :value="item.art"
                                            :options="artsAll"
                                            multiple
                                            />
                                </div>
                                <div class="form-group">
                                    <label for="type">Τύπος</label>
                                    <div class="radio">
                                        <label>
                                            <input
                                                    type="radio"
                                                    name="type"
                                                    :value="item.type"
                                                    :checked="item.type === 'Εισήγηση'"
                                                    @change="updateType('Εισήγηση')"
                                                    >
                                            Εισήγηση
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input
                                                    type="radio"
                                                    name="type"
                                                    :value="item.type"
                                                    :checked="item.type === 'Εργαστήριο: βιωματικές δράσεις'"
                                                    @change="updateType('Εργαστήριο: βιωματικές δράσεις')"
                                                    >
                                            Εργαστήριο: βιωματικές δράσεις
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input
                                                    type="radio"
                                                    name="type"
                                                    :value="item.type"
                                                    :checked="item.type === 'Εργαστήριο: καλές πρακτικές'"
                                                    @change="updateType('Εργαστήριο: καλές πρακτικές')"
                                                    >
                                            Εργαστήριο: καλές πρακτικές
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="duration">Διάρκεια</label>
                                    <div class="radio">
                                        <label>
                                            <input
                                                    type="radio"
                                                    name="duration"
                                                    :value="item.duration"
                                                    :checked="item.duration === '20'"
                                                    @change="updateDuration('20')"
                                                    >
                                            20
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input
                                                    type="radio"
                                                    name="duration"
                                                    :value="item.duration"
                                                    :checked="item.duration === '45'"
                                                    @change="updateDuration('45')"
                                                    >
                                            45
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input
                                                    type="radio"
                                                    name="duration"
                                                    :value="item.duration"
                                                    :checked="item.duration === '90'"
                                                    @change="updateDuration('90')"
                                                    >
                                            90
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name">Ονοματεπώνυμο</label>
                                    <input
                                            type="text"
                                            class="form-control"
                                            name="name"
                                            placeholder="Enter Ονοματεπώνυμο"
                                            :value="item.name"
                                            @input="updateName"
                                            >
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input
                                            type="email"
                                            class="form-control"
                                            name="email"
                                            placeholder="Enter Email"
                                            :value="item.email"
                                            @input="updateEmail"
                                            >
                                </div>
                                <div class="form-group">
                                    <label for="attribute">Ιδιότητα</label>
                                    <div class="radio">
                                        <label>
                                            <input
                                                    type="radio"
                                                    name="attribute"
                                                    :value="item.attribute"
                                                    :checked="item.attribute === 'Πανεπιστημιακός'"
                                                    @change="updateAttribute('Πανεπιστημιακός')"
                                                    >
                                            Πανεπιστημιακός
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input
                                                    type="radio"
                                                    name="attribute"
                                                    :value="item.attribute"
                                                    :checked="item.attribute === 'Ερευνητής'"
                                                    @change="updateAttribute('Ερευνητής')"
                                                    >
                                            Ερευνητής
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input
                                                    type="radio"
                                                    name="attribute"
                                                    :value="item.attribute"
                                                    :checked="item.attribute === 'Μεταπτυχιακός φοιτητής'"
                                                    @change="updateAttribute('Μεταπτυχιακός φοιτητής')"
                                                    >
                                            Μεταπτυχιακός φοιτητής
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input
                                                    type="radio"
                                                    name="attribute"
                                                    :value="item.attribute"
                                                    :checked="item.attribute === 'Εκπαιδευτικός Β/θμιας Εκπ/σης'"
                                                    @change="updateAttribute('Εκπαιδευτικός Β/θμιας Εκπ/σης')"
                                                    >
                                            Εκπαιδευτικός Β/θμιας Εκπ/σης
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input
                                                    type="radio"
                                                    name="attribute"
                                                    :value="item.attribute"
                                                    :checked="item.attribute === 'Εκπαιδευτικός Α/θμιας Εκπ/σης'"
                                                    @change="updateAttribute('Εκπαιδευτικός Α/θμιας Εκπ/σης')"
                                                    >
                                            Εκπαιδευτικός Α/θμιας Εκπ/σης
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input
                                                    type="radio"
                                                    name="attribute"
                                                    :value="item.attribute"
                                                    :checked="item.attribute === 'Καλλιτέχνης'"
                                                    @change="updateAttribute('Καλλιτέχνης')"
                                                    >
                                            Καλλιτέχνης
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input
                                                    type="radio"
                                                    name="attribute"
                                                    :value="item.attribute"
                                                    :checked="item.attribute === 'Άλλο'"
                                                    @change="updateAttribute('Άλλο')"
                                                    >
                                            Άλλο
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="document">Αρχείο</label>
                                    <input
                                            type="file"
                                            class="form-control"
                                            @change="updateDocument"
                                            multiple="multiple"
                                    >
                                    <ul v-if="item.document || item.uploaded_document" class="list-unstyled">
                                        <li v-for="document in item.uploaded_document">
                                            {{ document.file_name }}
                                            <button class="btn btn-xs btn-danger"
                                                    type="button"
                                                    @click="removeUploadedDocument($event, document.id);"
                                            >
                                                Remove file
                                            </button>
                                        </li>
                                        <li v-for="(document, index) in item.document">
                                            {{ document.name }}
                                            <button class="btn btn-xs btn-danger"
                                                    type="button"
                                                    @click="removeDocument($event, index);"
                                            >
                                                Remove file
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="form-group">
                                    <label for="assign">Ανάθεση</label>
                                    <v-select
                                            name="assign"
                                            label="name"
                                            @input="updateAssign"
                                            :value="item.assign"
                                            :options="usersAll"
                                            multiple
                                            />
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <div class="radio">
                                        <label>
                                            <input
                                                    type="radio"
                                                    name="status"
                                                    :value="item.status"
                                                    :checked="item.status === 'Accepted'"
                                                    @change="updateStatus('Accepted')"
                                                    >
                                            Accepted
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input
                                                    type="radio"
                                                    name="status"
                                                    :value="item.status"
                                                    :checked="item.status === 'Rejected'"
                                                    @change="updateStatus('Rejected')"
                                                    >
                                            Rejected
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input
                                                    type="radio"
                                                    name="status"
                                                    :value="item.status"
                                                    :checked="item.status === 'Pending'"
                                                    @change="updateStatus('Pending')"
                                                    >
                                            Pending
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="informed">Informed *</label>
                                    <div class="radio">
                                        <label>
                                            <input
                                                    type="radio"
                                                    name="informed"
                                                    :value="item.informed"
                                                    :checked="item.informed === ' Unaware'"
                                                    @change="updateInformed(' Unaware')"
                                                    >
                                             Unaware
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input
                                                    type="radio"
                                                    name="informed"
                                                    :value="item.informed"
                                                    :checked="item.informed === ' Informed'"
                                                    @change="updateInformed(' Informed')"
                                                    >
                                             Informed
                                        </label>
                                    </div>
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
        ...mapGetters('PapersSingle', ['item', 'loading', 'artsAll', 'usersAll'])
    },
    created() {
        this.fetchArtsAll(),
        this.fetchUsersAll()
    },
    destroyed() {
        this.resetState()
    },
    methods: {
        ...mapActions('PapersSingle', ['storeData', 'resetState', 'setTitle', 'setArt', 'setType', 'setDuration', 'setName', 'setEmail', 'setAttribute', 'setDocument', 'destroyDocument', 'destroyUploadedDocument', 'setAssign', 'setStatus', 'setInformed', 'fetchArtsAll', 'fetchUsersAll']),
        updateTitle(e) {
            this.setTitle(e.target.value)
        },
        updateArt(value) {
            this.setArt(value)
        },
        updateType(value) {
            this.setType(value)
        },
        updateDuration(value) {
            this.setDuration(value)
        },
        updateName(e) {
            this.setName(e.target.value)
        },
        updateEmail(e) {
            this.setEmail(e.target.value)
        },
        updateAttribute(value) {
            this.setAttribute(value)
        },
        removeDocument(e, id) {
            this.$swal({
                title: 'Are you sure?',
                text: "To fully delete the file submit the form.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                confirmButtonColor: '#dd4b39',
                focusCancel: true,
                reverseButtons: true
            }).then(result => {
                if (typeof result.dismiss === "undefined") {
                    this.destroyDocument(id);
                }
            })
        },
        updateDocument(e) {
            this.setDocument(e.target.files);
            this.$forceUpdate();
        },
        removeUploadedDocument (e, id) {
        this.$swal({
          title: 'Are you sure ? ',
          text: "To fully delete the file submit the form.",
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Delete',
          confirmButtonColor: '#dd4b39',
          focusCancel: true,
          reverseButtons: true
        }).
        then(result => {
            if (typeof result.dismiss === "undefined") {
                this.destroyUploadedDocument(id);
            }
        })
        },
        updateAssign(value) {
            this.setAssign(value)
        },
        updateStatus(value) {
            this.setStatus(value)
        },
        updateInformed(value) {
            this.setInformed(value)
        },
        submitForm() {
            this.storeData()
                .then(() => {
                    this.$router.push({ name: 'papers.index' })
                    this.$eventHub.$emit('create-success')
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
