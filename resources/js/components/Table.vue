<template>
    <div>
        <table class="table text-center justify-content-center">
            <thead>
                <tr>
                    <th v-for="t, key in titulos" :key="key" class="text-uppercase">{{ t }}</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <tr v-for="obj in dados" :key="obj.id">
                   <template v-for="valor, chave in obj">
                        <td v-if="titulos.includes(chave)" :key="chave">
                            {{ chave }}
                        </td>
                   </template>
                    <!-- <td>{{ m.id }}</td>
                    <td class="text-center">
                        <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center"
                            style="padding-left: 29%;padding-right: 29%;">
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                class="avatar avatar-xs pull-up" title="" data-bs-original-title="Lucas">
                                <img :src="'/storage/'+m.imagem" alt="Avatar" class="rounded-circle" style="width: 50%;">
                            </li>
                        </ul>
                    </td>
                    <td>{{ m.nome }}</td> -->
                    <!-- <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="/showuser?id=1"><i class="bx bx-edit-alt me-1"></i>
                                    Editar</a>
                            </div>
                        </div>
                    </td> -->
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: [
        'dados',
        'titulos'
    ]
}
</script>