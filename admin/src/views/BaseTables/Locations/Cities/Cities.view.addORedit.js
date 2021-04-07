
$("#country_id").getOptions({
    url: 'controllers/BaseTables/Locations/States/States',
    target: 'state_id',
    controller_type: 'getStateInCountry',
    rest: {
        request: 'options'
    }
});
