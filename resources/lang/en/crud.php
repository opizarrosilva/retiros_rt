<?php

return [
    'common' => [
        'actions' => 'Acciones',
        'create' => 'Crear',
        'edit' => 'Editar',
        'update' => 'Actualizar',
        'new' => 'Nuevo',
        'cancel' => 'Cancelar',
        'save' => 'Guardar',
        'delete' => 'Borrar',
        'delete_selected' => 'Borrar seleccion',
        'search' => 'Buscar...',
        'back' => 'Regresar al inicio',
        'are_you_sure' => 'Esta segur@?',
        'no_items_found' => 'No se encontraron registros',
        'created' => 'Creado satisfactoriamente',
        'saved' => 'Grabado satisfactoriamente',
        'removed' => 'Eliminado satisfactoriamente',
    ],

    'estadoretiros' => [
        'name' => 'Estado Retiros',
        'index_title' => 'Estado Retiros',
        'new_title' => 'Nuevo Estadoretiro',
        'create_title' => 'Crear Estado Retiro',
        'edit_title' => 'Editar Estado Retiro',
        'show_title' => 'Mostrar Estado Retiro',
        'inputs' => [
            'glosa' => 'Estado Retiro',
        ],
    ],

    'bloquehorarios' => [
        'name' => 'Bloque Horarios',
        'index_title' => 'Bloque Horarios',
        'new_title' => 'Nuevo Bloque Horario',
        'create_title' => 'Crear Bloque horario',
        'edit_title' => 'Editar Bloque horario',
        'show_title' => 'Mostrar Bloque horario',
        'inputs' => [
            'horainicio' => 'Hora inicio',
            'horafin' => 'Hora fin',
        ],
    ],

    'atributos' => [
        'name' => 'Atributos',
        'index_title' => 'Atributos',
        'new_title' => 'Nuevo Atributo',
        'create_title' => 'Crear Atributo',
        'edit_title' => 'Editar Atributo',
        'show_title' => 'Mostrar Atributo',
        'inputs' => [
            'glosa' => 'Glosa',
        ],
    ],

    'tipoevidencias' => [
        'name' => 'Tipo Evidencia',
        'index_title' => 'Tipo Eevidencia',
        'new_title' => 'Nuevo Tipo evidencia',
        'create_title' => 'Crear Tipo Evidencia',
        'edit_title' => 'Editar Tipo Evidencia',
        'show_title' => 'Mostrar Tipo Evidencia',
        'inputs' => [
            'glosa' => 'Glosa',
        ],
    ],

    'clientes' => [
        'name' => 'Clientes',
        'index_title' => 'Clientes',
        'new_title' => 'Nuevo Cliente',
        'create_title' => 'Crear Cliente',
        'edit_title' => 'Editar Cliente',
        'show_title' => 'Mostrar Cliente',
        'inputs' => [
            'glosa' => 'Nombre Cliente',
            'codigointerno' => 'Codigo Interno',
        ],
    ],

    'bitacoras' => [
        'name' => 'Bitacoras',
        'index_title' => 'Bitacora',
        'new_title' => 'Nuevo Bitacora',
        'create_title' => 'Crear Bitacora',
        'edit_title' => 'Editar Bitacora',
        'show_title' => 'Mostrar Bitacora',
        'inputs' => [
            'glosa' => 'Glosa',
            'retiro_id' => 'Retiro',
            'user_id' => 'User',
        ],
    ],

    'modificaciones' => [
        'name' => 'Modificaciones',
        'index_title' => 'Modificaciones',
        'new_title' => 'Nuevo Modificacion',
        'create_title' => 'Crear Modificacion',
        'edit_title' => 'Editar Modificacion',
        'show_title' => 'Mostrar Modificacion',
        'inputs' => [
            'atributo_id' => 'Atributo',
            'glosa' => 'Glosa',
            'retiro_id' => 'Retiro',
            'user_id' => 'User',
        ],
    ],

    'retiros' => [
        'name' => 'Retiros',
        'index_title' => 'Retiros',
        'new_title' => 'Nuevo Retiro',
        'create_title' => 'Creae Retiro',
        'edit_title' => 'Editar Retiro',
        'show_title' => 'Mostrar Retiro',
        'inputs' => [
            'cliente_id' => 'Cliente',
            'estadoretiro_id' => 'Estado Retiro',
            'fechacarga' => 'Fecha Carga',
            'glosa' => 'Glosa',
            'user_id' => 'User',
        ],
    ],

    'evidencias' => [
        'name' => 'Evidencias',
        'index_title' => 'Evidencias',
        'new_title' => 'Nueva Evidencia',
        'create_title' => 'Crear Evidencia',
        'edit_title' => 'Editar Evidencia',
        'show_title' => 'Mostrar Evidencia',
        'inputs' => [
            'tipoevidencia_id' => 'Tipo Evidencia',
            'url' => 'Url',
            'retiro_id' => 'Retiro',
            'user_id' => 'User',
        ],
    ],

    'agendas' => [
        'name' => 'Agendas',
        'index_title' => 'Agendas',
        'new_title' => 'Nueva Agenda',
        'create_title' => 'Crear Agenda',
        'edit_title' => 'Editar Agenda',
        'show_title' => 'Mostrar Agenda',
        'inputs' => [
            'fecha' => 'Fecha',
            'bloquehorario_id' => 'Bloque horario',
            'glosa' => 'Informacion Adicional',
            'retiro_id' => 'Retiro',
            'user_id' => 'User',
        ],
    ],

    'retiro_modificaciones' => [
        'name' => 'Retiro Modificaciones',
        'index_title' => 'Modificaciones',
        'new_title' => 'Nueva Modificacion',
        'create_title' => 'Crear Modificacione',
        'edit_title' => 'Editar Modificacione',
        'show_title' => 'Mostrar Modificacione',
        'inputs' => [
            'atributo_id' => 'Atributo',
            'glosa' => 'Glosa',
            'user_id' => 'User',
        ],
    ],

    'retiro_agendas' => [
        'name' => 'Retiro Agendas',
        'index_title' => 'Agendas',
        'new_title' => 'Nueva Agenda',
        'create_title' => 'Crear Agenda',
        'edit_title' => 'Editar Agenda',
        'show_title' => 'Mostrar Agenda',
        'inputs' => [
            'fecha' => 'Fecha',
            'bloquehorario_id' => 'Bloque horario',
            'glosa' => 'Glosa',
            'estadoagenda_id' => 'Estado agenda',
            'user_id' => 'Responsable',
        ],
    ],

    'retiro_evidencias' => [
        'name' => 'Retiro Evidencias',
        'index_title' => 'Evidencias',
        'new_title' => 'Nueva Evidencia',
        'create_title' => 'Crear Evidencia',
        'edit_title' => 'Editar Evidencia',
        'show_title' => 'Mostrar Evidencia',
        'inputs' => [
            'tipoevidencia_id' => 'Tipo evidencia',
            'url' => 'Url',
            'user_id' => 'User',
        ],
    ],

    'estadoagendas' => [
        'name' => 'Estado Agendas',
        'index_title' => 'Estado Agenda',
        'new_title' => 'Nuevo Estadoagenda',
        'create_title' => 'Crear Estado Agenda',
        'edit_title' => 'Editar Estado Agenda',
        'show_title' => 'Mostrar Estado Agenda',
        'inputs' => [
            'glosa' => 'Glosa',
        ],
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
        ],
    ],

    'estadollamados' => [
        'name' => 'Estado llamados',
        'index_title' => 'Estado llamados',
        'new_title' => 'Nuevo Estado llamado',
        'create_title' => 'Crear Estado llamado',
        'edit_title' => 'Editar Estado llamado',
        'show_title' => 'Mostrar Estado llamado',
        'inputs' => [
            'glosa' => 'Glosa',
        ],
    ],

    'llamados' => [
        'name' => 'Llamados',
        'index_title' => 'Llamados',
        'new_title' => 'New Llamado',
        'create_title' => 'Crear Llamado',
        'edit_title' => 'Editar Llamado',
        'show_title' => 'Mostrar Llamado',
        'inputs' => [
            'estadollamado_id' => 'Estadollamado',
            'retiro_id' => 'Retiro',
            'user_id' => 'User',
        ],
    ],

    'retiro_llamados' => [
        'name' => 'Retiro Llamados',
        'index_title' => 'Llamados',
        'new_title' => 'Llamado',
        'create_title' => 'Crear Llamado',
        'edit_title' => 'Editar Llamado',
        'show_title' => 'Mostrar Llamado',
        'inputs' => [
            'estadollamado_id' => 'Estadollamado',
            'user_id' => 'User',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List.',
        'create_title' => 'Crear Role',
        'edit_title' => 'Editar Role',
        'show_title' => 'Mostrar Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
