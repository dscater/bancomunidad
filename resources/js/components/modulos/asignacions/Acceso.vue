<template>
    <tr>
        <td>{{ perfil_sistema.perfil.nombre }}</td>
        <td>
            <el-switch
                class="d-block w-100"
                v-model="sw_acceso"
                active-text="SI"
                inactive-text="NO"
                active-color="#13ce66"
                inactive-color="#ff4949"
                @change="cambiaAcceso"
            >
            </el-switch>
        </td>
    </tr>
</template>
<script>
export default {
    props: ["perfil_sistema", "funcionario_id"],
    data() {
        return {
            _perfil_sistema: this.perfil_sistema,
            _funcionario_id: this.funcionario_id,
            sw_acceso: false,
        };
    },
    methods: {
        cambiaAcceso() {},
    },
};
</script>
<style></style>
