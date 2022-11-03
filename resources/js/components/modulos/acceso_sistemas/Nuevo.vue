<template>
    <div
        class="modal fade"
        :class="{ show: bModal }"
        id="modal-default"
        aria-modal="true"
        role="dialog"
    >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" v-text="tituloModal"></h4>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                        @click="cierraModal"
                    >
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.ci,
                                    }"
                                    >C.I.*</label
                                >
                                <el-input
                                    placeholder="Número de C.I."
                                    :class="{ 'is-invalid': errors.ci }"
                                    v-model="funcionario.ci"
                                    clearable
                                >
                                </el-input>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.ci"
                                    v-text="errors.ci[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.nombre,
                                    }"
                                    >Nombre*</label
                                >
                                <el-input
                                    placeholder="Nombre"
                                    :class="{ 'is-invalid': errors.nombre }"
                                    v-model="funcionario.nombre"
                                    clearable
                                >
                                </el-input>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.nombre"
                                    v-text="errors.nombre[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.paterno,
                                    }"
                                    >Ap. Paterno*</label
                                >

                                <el-input
                                    placeholder="Ap. Paterno"
                                    :class="{ 'is-invalid': errors.paterno }"
                                    v-model="funcionario.paterno"
                                    clearable
                                >
                                </el-input>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.paterno"
                                    v-text="errors.paterno[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.materno,
                                    }"
                                    >Ap. Materno*</label
                                >
                                <el-input
                                    placeholder="Ap. Materno*"
                                    :class="{ 'is-invalid': errors.materno }"
                                    v-model="funcionario.materno"
                                    clearable
                                >
                                </el-input>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.materno"
                                    v-text="errors.materno[0]"
                                ></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.cargo_id,
                                    }"
                                    >Cargo*</label
                                >
                                <el-select
                                    class="w-100 d-block"
                                    :class="{
                                        'is-invalid': errors.cargo_id,
                                    }"
                                    v-model="funcionario.cargo_id"
                                    clearable
                                >
                                    <el-option
                                        v-for="item in listCargos"
                                        :key="item.id"
                                        :value="item.id"
                                        :label="item.nombre"
                                    >
                                    </el-option>
                                </el-select>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.cargo_id"
                                    v-text="errors.cargo_id[0]"
                                ></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.regional_id,
                                    }"
                                    >Regional*</label
                                >
                                <div class="input-group">
                                    <select
                                        class="form-control"
                                        :class="{
                                            'is-invalid': errors.regional_id,
                                        }"
                                        v-model="funcionario.regional_id"
                                    >
                                        <option
                                            v-for="item in listRegionals"
                                            :key="item.id"
                                            :value="item.id"
                                            :label="item.nombre"
                                        ></option>
                                    </select>
                                    <div class="input-group-append">
                                        <button
                                            class="btn btn-outline-success"
                                            type="button"
                                        >
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <div
                                        class="input-group-append"
                                        v-if="funcionario.regional_id != ''"
                                    >
                                        <button
                                            class="btn btn-outline-danger"
                                            type="button"
                                        >
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.regional_id"
                                    v-text="errors.regional_id[0]"
                                ></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.agencia_id,
                                    }"
                                    >Agencias*</label
                                >
                                <div class="input-group">
                                    <select
                                        class="form-control"
                                        :class="{
                                            'is-invalid': errors.agencia_id,
                                        }"
                                        v-model="funcionario.agencia_id"
                                    >
                                        <option
                                            v-for="item in listRegionals"
                                            :key="item.id"
                                            :value="item.id"
                                            :label="item.nombre"
                                        ></option>
                                    </select>
                                    <div class="input-group-append">
                                        <button
                                            class="btn btn-outline-success"
                                            type="button"
                                        >
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <div
                                        class="input-group-append"
                                        v-if="funcionario.agencia_id != ''"
                                    >
                                        <button
                                            class="btn btn-outline-danger"
                                            type="button"
                                        >
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.agencia_id"
                                    v-text="errors.agencia_id[0]"
                                ></span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button
                        type="button"
                        class="btn btn-default"
                        data-dismiss="modal"
                        @click="cierraModal"
                    >
                        Cerrar
                    </button>
                    <el-button
                        type="primary"
                        class="bg-primary"
                        :loading="enviando"
                        @click="setRegistroModal()"
                        >{{ textoBoton }}</el-button
                    >
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        muestra_modal: {
            type: Boolean,
            default: false,
        },
        accion: {
            type: String,
            default: "nuevo",
        },
        funcionario: {
            type: Object,
            default: {
                id: 0,
                ci: "",
                nombre: "",
                paterno: "",
                materno: "",
                cargo_id: "",
                regional_id: "",
                agencia_id: "",
            },
        },
    },
    watch: {
        muestra_modal: function (newVal, oldVal) {
            this.errors = [];
            if (newVal) {
                this.bModal = true;
            } else {
                this.bModal = false;
            }
        },
    },
    computed: {
        tituloModal() {
            if (this.accion == "nuevo") {
                return "AGREGAR USUARIO";
            } else {
                return "MODIFICAR REGISTRO";
            }
        },
        textoBoton() {
            if (this.accion == "nuevo") {
                return "Registrar";
            } else {
                return "Actualizar";
            }
        },
    },
    data() {
        return {
            user: JSON.parse(localStorage.getItem("user")),
            bModal: this.muestra_modal,
            enviando: false,
            errors: [],
            listCargos: [],
            listRegionals: [],
            listAgencias: [],
        };
    },
    mounted() {
        this.bModal = this.muestra_modal;
    },
    methods: {
        //get Cargos
        getCargos() {
            axios.get("/admin/cargos").then((response) => {
                this.listCargos = response.data.cargos;
            });
        },
        //get Regionals
        getRegioanls() {
            axios.get("/admin/regionals").then((response) => {
                this.listRegioanls = response.data.regionals;
            });
        },
        //get Agencias
        getAgencias() {
            axios.get("/admin/agencias").then((response) => {
                this.listCargos = response.data.agencias;
            });
        },

        // envia modal
        setRegistroModal() {
            this.enviando = true;
            try {
                this.textoBtn = "Enviando...";
                let url = "/admin/funcionarios";
                let config = {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                };
                let formdata = new FormData();
                formdata.append(
                    "ci",
                    this.funcionario.ci ? this.funcionario.ci : ""
                );
                formdata.append(
                    "nombre",
                    this.funcionario.nombre ? this.funcionario.nombre : ""
                );
                formdata.append(
                    "paterno",
                    this.funcionario.paterno ? this.funcionario.paterno : ""
                );
                formdata.append(
                    "materno",
                    this.funcionario.materno ? this.funcionario.materno : ""
                );
                formdata.append(
                    "cargo_id",
                    this.funcionario.cargo_id ? this.funcionario.cargo_id : ""
                );
                formdata.append(
                    "regional_id",
                    this.funcionario.regional_id
                        ? this.funcionario.regional_id
                        : ""
                );
                formdata.append(
                    "agencia_id",
                    this.funcionario.agencia_id
                        ? this.funcionario.agencia_id
                        : ""
                );

                if (this.accion == "edit") {
                    url = "/admin/funcionarios/" + this.funcionario.id;
                    formdata.append("_method", "PUT");
                }
                axios
                    .post(url, formdata, config)
                    .then((res) => {
                        this.enviando = false;
                        Swal.fire({
                            icon: "success",
                            title: res.data.msj,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        this.limpiaFuncionario();
                        this.$emit("envioModal");
                        this.errors = [];
                        if (this.accion == "edit") {
                            this.textoBtn = "Actualizar";
                        } else {
                            this.textoBtn = "Registrar";
                        }
                    })
                    .catch((error) => {
                        this.enviando = false;
                        if (this.accion == "edit") {
                            this.textoBtn = "Actualizar";
                        } else {
                            this.textoBtn = "Registrar";
                        }
                        if (error.response) {
                            if (error.response.status === 422) {
                                this.errors = error.response.data.errors;
                            }
                        }
                    });
            } catch (e) {
                this.enviando = false;
                console.log(e);
            }
        },
        // Dialog/modal
        cierraModal() {
            this.bModal = false;
            this.$emit("close");
        },
        limpiaFuncionario() {
            this.errors = [];
            this.funcionario.ci = "";
            this.funcionario.nombre = "";
            this.funcionario.paterno = "";
            this.funcionario.materno = "";
            this.funcionario.cargo_id = "";
            this.funcionario.regional_id = "";
            this.funcionario.agencia_id = "";
        },
    },
};
</script>

<style></style>
