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
            document: null, uploaded_documents: [], documents: [],
            assign: [],
            status: null,
        },
        artsAll: [],
        usersAll: [],
        
        loading: false,
    }
}

const getters = {
    item: state => state.item,
    loading: state => state.loading,
    artsAll: state => state.artsAll,
    usersAll: state => state.usersAll,
    
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
            params.set('uploaded_documents', state.item.uploaded_documents.map(function (item) {
                            return item.id
            }))
            if (_.isEmpty(state.item.assign)) {
                params.delete('assign')
            } else {
                for (let index in state.item.assign) {
                    params.set('assign['+index+']', state.item.assign[index].id)
                }
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
            params.set('uploaded_documents', state.item.uploaded_documents.map(function (item) {
                            return item.id
            }))
            if (_.isEmpty(state.item.assign)) {
                params.delete('assign')
            } else {
                for (let index in state.item.assign) {
                    params.set('assign['+index+']', state.item.assign[index].id)
                }
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
      uploadDocument({commit}, value) {
        commit('setDocument', value);
    },
    destroyDocument({commit}, value) {
        commit('removeDocument', value);
    },
    destroyUploadedDocument({commit}, value) {
        commit('removeUploadedDocument', value);
    },
    setAssign({ commit }, value) {
        commit('setAssign', value)
    },
    setStatus({ commit }, value) {
        commit('setStatus', value)
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
                if (typeof state.item.documents === "undefined") {
                    state.item.documents = [];
                }
                state.item.documents.push(document);
            }
        }
    },
    removeDocument(state, value) {
        for (let i in state.item.uploaded_documents) {
            let data = state.item.uploaded_documents[i];
            if (data.id === value) {
                state.item.uploaded_documents.splice(i, 1);
            }
        }
    },
    removeUploadedDocument(state, value) {
        for (let i in state.item.documents) {
            if (i == value) {
                state.item.documents.splice(i, 1);
            }
        }
    },
    setAssign(state, value) {
        state.item.assign = value
    },
    setStatus(state, value) {
        state.item.status = value
    },
    setArtsAll(state, value) {
        state.artsAll = value
    },
    setUsersAll(state, value) {
        state.usersAll = value
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
