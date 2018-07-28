function initialState() {
    return {
        item: {
            id: null,
            title: null,
            art: [],
            type: null,
            duration: null,
            name: null,
            email: null,
            attribute: null,
            document: [],
            uploaded_document: [],
            assign: [],
            status: null,
            informed: null,
            reviews: null,
            messages: null,
        },
        artsAll: [],
        usersAll: [],
        judgementsAll: [],
        messagesAll: [],
        
        loading: false,
    }
}

const getters = {
    item: state => state.item,
    loading: state => state.loading,
    artsAll: state => state.artsAll,
    usersAll: state => state.usersAll,
    judgementsAll: state => state.judgementsAll,
    messagesAll: state => state.messagesAll,
    
}

const actions = {
    storeData({ commit, state, dispatch }) {
        commit('setLoading', true)
        dispatch('Alert/resetState', null, { root: true })

        return new Promise((resolve, reject) => {
            let params = new FormData();

            for (let fieldName in state.item) {
                let fieldValue = state.item[fieldName];
                if (typeof fieldValue !== 'object') {
                    params.set(fieldName, fieldValue);
                } else {
                    if (fieldValue && typeof fieldValue[0] !== 'object') {
                        params.set(fieldName, fieldValue);
                    } else {
                        for (let index in fieldValue) {
                            params.set(fieldName + '[' + index + ']', fieldValue[index]);
                        }
                    }
                }
            }

            if (_.isEmpty(state.item.art)) {
                params.delete('art')
            } else {
                for (let index in state.item.art) {
                    params.set('art['+index+']', state.item.art[index].id)
                }
            }
            params.set('uploaded_document', state.item.uploaded_document.map(o => o['id']))
            if (_.isEmpty(state.item.assign)) {
                params.delete('assign')
            } else {
                for (let index in state.item.assign) {
                    params.set('assign['+index+']', state.item.assign[index].id)
                }
            }
            if (_.isEmpty(state.item.reviews)) {
                params.set('reviews_id', '')
            } else {
                params.set('reviews_id', state.item.reviews.id)
            }
            if (_.isEmpty(state.item.messages)) {
                params.set('messages_id', '')
            } else {
                params.set('messages_id', state.item.messages.id)
            }

            axios.post('/api/v1/papers', params)
                .then(response => {
                    commit('resetState')
                    resolve()
                })
                .catch(error => {
                    let message = error.response.data.message || error.message
                    let errors  = error.response.data.errors

                    dispatch(
                        'Alert/setAlert',
                        { message: message, errors: errors, color: 'danger' },
                        { root: true })

                    reject(error)
                })
                .finally(() => {
                    commit('setLoading', false)
                })
        })
    },
    updateData({ commit, state, dispatch }) {
        commit('setLoading', true)
        dispatch('Alert/resetState', null, { root: true })

        return new Promise((resolve, reject) => {
            let params = new FormData();
            params.set('_method', 'PUT')

            for (let fieldName in state.item) {
                let fieldValue = state.item[fieldName];
                if (typeof fieldValue !== 'object') {
                    params.set(fieldName, fieldValue);
                } else {
                    if (fieldValue && typeof fieldValue[0] !== 'object') {
                        params.set(fieldName, fieldValue);
                    } else {
                        for (let index in fieldValue) {
                            params.set(fieldName + '[' + index + ']', fieldValue[index]);
                        }
                    }
                }
            }

            if (_.isEmpty(state.item.art)) {
                params.delete('art')
            } else {
                for (let index in state.item.art) {
                    params.set('art['+index+']', state.item.art[index].id)
                }
            }
            params.set('uploaded_document', state.item.uploaded_document.map(o => o['id']))
            if (_.isEmpty(state.item.assign)) {
                params.delete('assign')
            } else {
                for (let index in state.item.assign) {
                    params.set('assign['+index+']', state.item.assign[index].id)
                }
            }
            if (_.isEmpty(state.item.reviews)) {
                params.set('reviews_id', '')
            } else {
                params.set('reviews_id', state.item.reviews.id)
            }
            if (_.isEmpty(state.item.messages)) {
                params.set('messages_id', '')
            } else {
                params.set('messages_id', state.item.messages.id)
            }

            axios.post('/api/v1/papers/' + state.item.id, params)
                .then(response => {
                    commit('setItem', response.data.data)
                    resolve()
                })
                .catch(error => {
                    let message = error.response.data.message || error.message
                    let errors  = error.response.data.errors

                    dispatch(
                        'Alert/setAlert',
                        { message: message, errors: errors, color: 'danger' },
                        { root: true })

                    reject(error)
                })
                .finally(() => {
                    commit('setLoading', false)
                })
        })
    },
    fetchData({ commit, dispatch }, id) {
        axios.get('/api/v1/papers/' + id)
            .then(response => {
                commit('setItem', response.data.data)
            })

        dispatch('fetchArtsAll')
    dispatch('fetchUsersAll')
    dispatch('fetchJudgementsAll')
    dispatch('fetchMessagesAll')
    },
    fetchArtsAll({ commit }) {
        axios.get('/api/v1/arts')
            .then(response => {
                commit('setArtsAll', response.data.data)
            })
    },
    fetchUsersAll({ commit }) {
        axios.get('/api/v1/users')
            .then(response => {
                commit('setUsersAll', response.data.data)
            })
    },
    fetchJudgementsAll({ commit }) {
        axios.get('/api/v1/judgements')
            .then(response => {
                commit('setJudgementsAll', response.data.data)
            })
    },
    fetchMessagesAll({ commit }) {
        axios.get('/api/v1/messages')
            .then(response => {
                commit('setMessagesAll', response.data.data)
            })
    },
    setTitle({ commit }, value) {
        commit('setTitle', value)
    },
    setArt({ commit }, value) {
        commit('setArt', value)
    },
    setType({ commit }, value) {
        commit('setType', value)
    },
    setDuration({ commit }, value) {
        commit('setDuration', value)
    },
    setName({ commit }, value) {
        commit('setName', value)
    },
    setEmail({ commit }, value) {
        commit('setEmail', value)
    },
    setAttribute({ commit }, value) {
        commit('setAttribute', value)
    },
    setDocument({ commit }, value) {
        commit('setDocument', value)
    },
    destroyDocument({ commit }, value) {
        commit('destroyDocument', value)
    },
    destroyUploadedDocument({ commit }, value) {
        commit('destroyUploadedDocument', value)
    },
    setAssign({ commit }, value) {
        commit('setAssign', value)
    },
    setStatus({ commit }, value) {
        commit('setStatus', value)
    },
    setInformed({ commit }, value) {
        commit('setInformed', value)
    },
    setReviews({ commit }, value) {
        commit('setReviews', value)
    },
    setMessages({ commit }, value) {
        commit('setMessages', value)
    },
    resetState({ commit }) {
        commit('resetState')
    }
}

const mutations = {
    setItem(state, item) {
        state.item = item
    },
    setTitle(state, value) {
        state.item.title = value
    },
    setArt(state, value) {
        state.item.art = value
    },
    setType(state, value) {
        state.item.type = value
    },
    setDuration(state, value) {
        state.item.duration = value
    },
    setName(state, value) {
        state.item.name = value
    },
    setEmail(state, value) {
        state.item.email = value
    },
    setAttribute(state, value) {
        state.item.attribute = value
    },
    setDocument(state, value) {
        for (let i in value) {
            let document = value[i];
            if (typeof document === "object") {
                state.item.document.push(document);
            }
        }
    },
    destroyDocument(state, value) {
        for (let i in state.item.document) {
            if (i == value) {
                state.item.document.splice(i, 1);
            }
        }
    },
    destroyUploadedDocument(state, value) {
        for (let i in state.item.uploaded_document) {
            let data = state.item.uploaded_document[i];
            if (data.id === value) {
                state.item.uploaded_document.splice(i, 1);
            }
        }
    },
    setAssign(state, value) {
        state.item.assign = value
    },
    setStatus(state, value) {
        state.item.status = value
    },
    setInformed(state, value) {
        state.item.informed = value
    },
    setReviews(state, value) {
        state.item.reviews = value
    },
    setMessages(state, value) {
        state.item.messages = value
    },
    setArtsAll(state, value) {
        state.artsAll = value
    },
    setUsersAll(state, value) {
        state.usersAll = value
    },
    setJudgementsAll(state, value) {
        state.judgementsAll = value
    },
    setMessagesAll(state, value) {
        state.messagesAll = value
    },
    
    setLoading(state, loading) {
        state.loading = loading
    },
    resetState(state) {
        state = Object.assign(state, initialState())
    }
}

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}
