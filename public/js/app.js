/*
* Base de acesso a api
 */
const candidateBaseApi = axios.create({
    baseURL: 'http://localhost:8080/candidates',
    timeout: 2000
})
const candidatePaginate = (page) => candidateBaseApi.get('?page=' + page);
const candidateCreate = ({name, email}) => candidateBaseApi.post('/',{name: name, email: email});
const candidateUpdate = ({id, name, email}) => candidateBaseApi.put('/' + id, {name: name, email: email});
const candidateDelete = ({id}) => candidateBaseApi.delete('/' + id);

const app = new Vue({
    el: '#app',
    data() {
        return {
            currentPage: 1,
            totalRows: 0,
            fields: {
                id: {
                    label: '#',
                    sortable: true
                },
                name: {
                    label: 'Nome',
                    sortable: true
                },
                email: {
                    label: 'Email',
                    sortable: true
                },
                action: {
                    label: 'Ações'
                }
            },
            items: []
        }
    },
    methods: {
        getCandidates: function () {
            candidatePaginate(this.currentPage)
                .then(response => response.data)
                .then(data => {
                    this.items = data.data;
                    this.currentPage = data.current_page;
                    this.totalRows = data.total;
                })
        },
        onPagination: function (page) {
            this.currentPage = page;
            this.getCandidates()
        },
        addCandidate: function () {
            swal.setDefaults({
                progressSteps: ['1', '2']
            })
            swal.queue([
                {
                    input: 'text',
                    title: 'Nome do candidato',
                    confirmButtonText: 'Próximo &rarr;',
                    cancelButtonText: 'Cancelar',
                    showCancelButton: true,
                    inputValidator: (value) => {
                        return !value && 'Precisa informar o Nome'
                    }
                },
                {
                    input: 'email',
                    title: 'Email do candidato',
                    confirmButtonText: 'Confirmar',
                    cancelButtonText: 'Cancelar',
                    showCancelButton: true,
                    inputValidator: (value) => {
                        let emailRegex = /^[a-zA-Z0-9.+_-]+@[a-zA-Z0-9.-]+\.[a-zA-Z0-9-]{2,24}$/;
                        return !emailRegex.test(value) && 'Precisa informar o Email'
                    }
                }
                ])
                .then((result) => {
                    swal.resetDefaults()
                    candidateCreate({name:result.value[0], email: result.value[1]})
                        .then(response => response.data)
                        .then(data => {
                            if(!data.error)
                                swal({
                                    type: 'success',
                                    title: 'Candidato adiciona com sucesso'
                                })
                            if(data.error)
                                swal({
                                    type: 'error',
                                    title: this.parseErrorMessage(data.message)
                                })
                            this.getCandidates()
                        })
                })
        },
        editCandidate: function (candidate) {
            swal.setDefaults({
                progressSteps: ['1', '2']
            })
            swal.queue([
                {
                    input: 'text',
                    inputValue: candidate.name,
                    title: 'Nome do candidato',
                    confirmButtonText: 'Próximo &rarr;',
                    cancelButtonText: 'Cancelar',
                    showCancelButton: true,
                    inputValidator: (value) => {
                        return !value && 'Precisa informar o Nome'
                    }
                },
                {
                    input: 'email',
                    inputValue: candidate.email,
                    title: 'Email do candidato',
                    confirmButtonText: 'Confirmar',
                    cancelButtonText: 'Cancelar',
                    showCancelButton: true,
                    inputValidator: (value) => {
                        let emailRegex = /^[a-zA-Z0-9.+_-]+@[a-zA-Z0-9.-]+\.[a-zA-Z0-9-]{2,24}$/;
                        return !emailRegex.test(value) && 'Precisa informar o Email'
                    }
                }
            ])
                .then((result) => {
                    swal.resetDefaults()
                    candidateUpdate({id: candidate.id, name:result.value[0], email: result.value[1]})
                        .then(response => response.data)
                        .then(data => {
                            if(!data.error)
                                swal({
                                    type: 'success',
                                    title: 'Candidato atualizado com sucesso'
                                })
                            if(data.error)
                                swal({
                                    type: 'error',
                                    title: this.parseErrorMessage(data.message)
                                })
                            this.getCandidates()
                        })
                })
        },
        removeCandidate: function (candidate) {
            swal({
                title: 'Você tem certeza?',
                text: "Esta ação irá apagar permanentemente os dados!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirmar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                    candidateDelete({id: candidate.id})
                        .then(response => response.data)
                        .then(data => {
                            if(!data.error)
                                swal({
                                    type: 'success',
                                    title: 'Candidato removido com sucesso'
                                })
                            if(data.error)
                                swal({
                                    type: 'error',
                                    title: this.parseErrorMessage(data.message)
                                })
                            this.getCandidates()
                        })
                }
            })
        },
        parseErrorMessage: function (error) {
            if(typeof error == 'string')
                return error;
            if(typeof error !== 'object')
                return 'Problema identificiado';
            let message = '';
            for( let i in error) {
                if(typeof error[i] == 'string')
                    message = '<p>'+ error[i] + '</p>'
                for ( let j in error[i])
                    message = '<p>'+ error[i][j] + '</p>'
            }
            return message;
        }
    },
    created() {
        this.getCandidates()
    }
})