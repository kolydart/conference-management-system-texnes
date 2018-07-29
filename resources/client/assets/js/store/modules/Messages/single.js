function initialState() {
    return {
        item: {
            id: null,
            paper: null,
            address: null,
            name: null,
            body: null,
        },
        papersAll: [],
        
        loading: false,
    }
}

const getters = {
    item: state => state.item,
    loading: state => state.loading,
    papersAll: state => state.papersAll,
    
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

            if (_.isEmpty(state.item.paper)) {
                params.set('paper_id', '')
            } else {
                params.set('paper_id', state.item.paper.id)
            }

            axios.post('/api/v1/messages', params)
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

            if (_.isEmpty(state.item.paper)) {
                params.set('paper_id', '')
            } else {
                params.set('paper_id', state.item.paper.id)
            }

            axios.post('/api/v1/messages/' + state.item.id, params)
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
        axios.get('/api/v1/messages/' + id)
            .then(response => {
                commit('setItem', response.data.data)
            })

        dispatch('fetchPapersAll')
    },
    fetchPapersAll({ commit }) {
        axios.get('/api/v1/papers')
            .then(response => {
                commit('setPapersAll', response.data.data)
            })
    },
    setPaper({ commit }, value) {
        commit('setPaper', value)
    },
    setAddress({ commit }, value) {
        commit('setAddress', value)
    },
    setName({ commit }, value) {
        commit('setName', value)
    },
    setBody({ commit }, value) {
        commit('setBody', value)
    },
    resetState({ commit }) {
        commit('resetState')
    }
}

const mutations = {
    setItem(state, item) {
        state.item = item
    },
    setPaper(state, value) {
        state.item.paper = value
    },
    setAddress(state, value) {
        state.item.address = value
    },
    setName(state, value) {
        state.item.name = value
    },
    setBody(state, value) {
        state.item.body = value
    },
    setPapersAll(state, value) {
        state.papersAll = value
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