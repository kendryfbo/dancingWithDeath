var app = new Vue({

    el: '#vue-app',

    data: {
        name: '',
        email: '',
        date: '',
        availablesHours: [],
        hour: '',
        scheduled: false
    },

    methods: {

        getAvailableHours: function() {

            var url ='/api/appointments/date/?date=' + this.date;

            axios.get(url)
            .then(response => this.loadAvailableHours(response.data))
            .catch(error => this.handleError(error));
        },


        loadAvailableHours: function(data) {

            this.availablesHours = data;
        },

        loadHour: function(hour) {

            this.hour = hour;
        },

        clearInputs: function() {

            this.name = '';
            this.email = '';
            this.hour = '';
            this.availablesHours = [];
        },

        scheduledAppointment: function() {

            this.scheduled =true;
            this.clearInputs();
            this.getAvailableHours();
        },

        storeAppointment: function() {

            var validation = this.validateInputs();

            if (!validation) {

                alert('Invalid Inputs');

                return;
            }

            var url='/api/appointments/';

            axios.post(url,{
                name: this.name,
                email: this.email,
                date: this.date,
                time: this.hour
            })
            .then(response => this.scheduledAppointment() )
            .catch(error => this.handleError(error))
        },


        validateInputs: function() {

            var validation = false;

            if ( (this.name) && (this.email) && (this.date) && (this.hour) ) {

                validation = true;
            }

            return validation;
        },

        handleError: function(error) {

            if (error.response) {

                var data = error.response.data;

                if (typeof data === 'string') {

                    alert(data);

                } else if (typeof data === 'object') {

                    for (var prop in data) {

                        alert(`${data[prop]}`);
                    }
                }

                console.log(error.response);
            }
        }
    }
});
