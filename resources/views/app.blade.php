<html>
<head>
    <meta charset="UTF-8">
    <!-- Add this to <head> -->
    <link type="text/css" rel="stylesheet" href="https://unpkg.com/bootstrap@next/dist/css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.css"/>
    <style>
        #app {
            padding-top: 50px;
        }
    </style>
</head>
<body>
<div id="app">
    <div class="container">
        <b-card header-tag="header" footer-tag="footer">
            <div slot="header">
                <b-row align-h="between">
                    <b-col cols="6">
                        <h4>Lista de candidatos</h4>
                    </b-col>
                    <b-col cols="2">
                        <b-button  variant="primary" @click.stop="addCandidate">Adicionar</b-button>
                    </b-col>
                </b-row>
            </div>
            <b-table striped hover :items="items" :fields="fields">
                <template slot="action" scope="row">
                    <b-button variant="primary" @click.stop="editCandidate(row.item)">Editar</b-button>
                    <b-button variant="danger" @click.stop="removeCandidate(row.item)">Remover</b-button>
                </template>
            </b-table>
            <div slot="footer">
                <b-row>
                    <b-col>
                        <b-pagination size="md" @change="onPagination" :total-rows="totalRows" v-model="currentPage" per-page="15">
                        </b-pagination>
                    </b-col>
                </b-row>
            </div>
        </b-card>
    </div>
</div>
<script type="application/javascript" src="https://cdn.jsdelivr.net/npm/vue"></script>
<script type="application/javascript" src="https://unpkg.com/babel-polyfill@latest/dist/polyfill.min.js"></script>
<script type="application/javascript" src="https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.js"></script>
<script type="application/javascript" src="https://unpkg.com/sweetalert2@7.0.9/dist/sweetalert2.all.js"></script>
<script type="application/javascript" src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="application/javascript" src="{{url('js/app.js')}}"></script>
</body>
</html>