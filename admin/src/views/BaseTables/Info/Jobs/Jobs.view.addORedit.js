
$("#workgroup_id").getOptions({
    url: 'controllers/BaseTables/Info/Castes/Castes',
    target: 'caste_id',
    controller_type: 'getCaseInWorkGroup',
    rest: {
        request: 'options'
    }
});
