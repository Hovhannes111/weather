const LocationAPI = {
    onSuccess: (res) => {
        console.log(res)
    },
    onFailure: (err) => {
        console.error(err.message)
    },
    getCountries: function (onSuccess = this.onSuccess, onFailure = this.onFailure) {
        $.ajax({
            type: 'GET',
            url: '/countries',
            success: onSuccess,
            error: onFailure
        })
    },
    getStates: function (countryId, onSuccess = this.onSuccess, onFailure = this.onFailure) {
        $.ajax({
            type: 'GET',
            url: `/states/${countryId}`,
            success: onSuccess,
            error: onFailure
        })
    },
    getStateCities: function (stateId, onSuccess = this.onSuccess, onFailure = this.onFailure) {
        $.ajax({
            type: 'GET',
            url: `/cities/state/${stateId}`,
            success: onSuccess,
            error: onFailure
        })
    },
    getCountryCities: function (countryId, onSuccess = this.onSuccess, onFailure = this.onFailure) {
        $.ajax({
            type: 'GET',
            url: `/cities/country/${countryId}`,
            success: onSuccess,
            error: onFailure
        })
    }
}


export default LocationAPI;
