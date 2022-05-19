const LocationAPI = {
    onSuccess: (res) => {
        console.log(res)
    },
    onFailure: (err) => {
        console.error(err.message)
    },
    getCountryLocationData: function (countryId, onSuccess = this.onSuccess, onFailure = this.onFailure) {
        $.ajax({
            type: 'GET',
            url: `/country/${countryId}`,
            success: onSuccess,
            error: onFailure
        })
    },
    getStateLocationData: function (stateId, onSuccess = this.onSuccess, onFailure = this.onFailure) {
        $.ajax({
            type: 'GET',
            url: `/state/${stateId}`,
            success: onSuccess,
            error: onFailure
        })
    },
}


export default LocationAPI;
