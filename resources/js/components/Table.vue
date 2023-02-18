<template>
    <table class="table text-center justify-content-center">
        <thead>
            <tr>
                <th>Foto da Marca</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            <tr>
                <td class="text-center">
                    <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center"
                        style="padding-left: 43%;padding-right: 43%;">
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                            class="avatar avatar-xs pull-up" title="" data-bs-original-title="Lucas">
                            <img src="" alt="Avatar"
                                class="rounded-circle">
                        </li>
                    </ul>
                </td>
                <td>Lucas</td>
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/showuser?id=1"><i class="bx bx-edit-alt me-1"></i> Editar</a>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>

</script>