<template>
    <div class="container mt-8">
        <loading
           v-model:active="isLoading"
           :can-cancel="false"
           :is-full-page=true
       />
      <h1 class="consultar">Consultar clima</h1><hr/>
      <div class="row">
        <div class="col-md-5">
          <div id="weatherapi-weather-widget-4">
              <div id="apixu_container"></div>
          </div>
        </div>
      </div>
        <div class="form">
            <div id="demo" class="min-h-full bg-gray-200">
                <div class="bg-gray-300 flex justify-center">
                <div class="w-full max-w-md">
                    <div class="space-y-6 m-8">
                    <div class="rounded-md shadow-sm">
                        <div class="col-4 form-group block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                        <pr>Seleccione una ciudad  </pr>
                        <select v-model.trim="city" id="country" name="country" class="form-control">
                            <option value="Miami">Miami</option>
                            <option value="Orlando">Orlando</option>
                            <option value="New York">New York</option>
                        </select>
                    </div>
                    </div>
                    </div>
                </div>
                </div>
                <div id="imagenes_mapa">
                    <div class="mx-auto max-w-4xl px-4 pricipal col-md=4">
                        <div class="text-left">
                            <div class="p-3">
                            <div class="p-6 bg-white shadow overflow-hidden sm:rounded-lg">
                                <div>
                                <h2></h2>
                                <p class="mt-2"></p>
                                <dl class="mt-4 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 sm:gap-y-10 lg:gap-x-4">
                                    <div class="border-t border-gray-200 pt-4">
                                        <dt class="font-large text-md text-gray-500">Temp</dt>
                                        <dd class="mt-2 font-medium text-7xl text-gray-900">{{ temp }}F</dd>
                                    </div>
                                    <div class="border-t border-gray-200 pt-4">
                                        <dt class="font-medium text-md text-gray-500">Max/Min</dt>
                                        <dd class="mt-2 text-4xl text-gray-900">{{ temp_max }} - {{ temp_min }}</dd>
                                    </div>
                                    <div class="border-t border-gray-200 pt-4">
                                        <dt class="font-medium text-md text-gray-500">Feels Like</dt>
                                        <dd class="mt-2 text-4xl text-gray-900">{{ feels_like }}</dd>
                                    </div>
                                    <div class="border-t border-gray-200 pt-4">
                                        <dt class="font-medium text-md text-gray-500">Humidity</dt>
                                        <dd class="mt-2 text-4xl text-gray-900">{{ humidity }}</dd>
                                    </div>
                                </dl>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="mx-auto max-w-4xl px-6 pricipal">
                        <p> Mapa ubicación</p><br>
                        <div id="mapContainer"></div>
                    </div>
                </div>
            </div><br/>
            <button type="submit" @click="onSubmit" class="btn btn-primary btn-lg boton_diseno"><i v-show="loading" class="fa fa-loading fa fa-eye" aria-hidden="true"></i>Guardar Clima
            </button><br/><br/>
        </div>
    </div>
  </template>
  <script>
  import { createApp } from 'vue';
  let Vue=createApp({})
  import "leaflet/dist/leaflet.css";
  import  L from '../leaflet';
  import Loading from 'vue-loading-overlay';
  import 'vue-loading-overlay/dist/css/index.css';


  export default {
       data() {
            return {
              city: '',
              country: 'Miami',
              loading: false,
              req_status: '', //app checker
              error_message: '',
              otherGender: null,
              weather: [],
              users_weather: {},
              awaitingSearch: false,
              map: null,
              temp: null,
              temp_max: null,
              temp_min: null,
              feels_like: null,
              humidity: null,
              isLoading:false
            }
        },
        watch: {
            city: function (val) {
                if (!this.awaitingSearch) {
                    this.isLoading=true;
                    setTimeout(() => {
                        this.getWeatherResults()
                        .then(response =>{
                            let lat_mapa =response.data.coord.lat;
                            let lon_mapa = response.data.coord.lon;
                            this.getCoordenadas(lat_mapa,lon_mapa);
                            this.temp = response.data.main.temp;
                            this.temp_max = response.data.main.temp_max;
                            this.temp_min = response.data.main.temp_min;
                            this.feels_like = response.data.main.feels_like;
                            this.humidity = response.data.main.humidity;
                            this.weather = response.data
                            this.req_status = 'Success'
                            this.isLoading=false;
                        })
                        .catch(err =>{
                            this.req_status = 'Error'
                            this.error_message = err
                        })
                        this.awaitingSearch = false
                    }, 1000) // 1 sec delay
                }
                this.awaitingSearch = true

            },
        },

        components:{
            Loading
        },

        mounted() {
            /***para el mapa */
            let cordenadas = '';
            this.map = L.map("mapContainer").setView([0,0], 9);
            L.tileLayer("http://{s}.tile.osm.org/{z}/{x}/{y}.png", {
            attribution:
            '',
            }).addTo(this.map);
            //use a mix of renderers
            var customPane = this.map.createPane("customPane");
            var canvasRenderer = L.canvas({ pane: "customPane" });
            customPane.style.zIndex = 399; // put just behind the standard overlay pane which is at 400
            /***End para el mapa */
        },

        onBeforeUnmount() {
            if (this.map) {
                this.map.remove();
            }
        },

        methods : {

            getCoordenadas(lat, lon) {
                this.map.remove();
                this.map = L.map("mapContainer").setView([lat,lon], 9);
                L.tileLayer("http://{s}.tile.osm.org/{z}/{x}/{y}.png", {
                attribution:
                '',
                }).addTo(this.map);
                //use a mix of renderers
                var customPane = this.map.createPane("customPane");
                var canvasRenderer = L.canvas({ pane: "customPane" });
                customPane.style.zIndex = 399; // put just behind the standard overlay pane which is at 400
                L.marker([lat, lon]).addTo(this.map);
            },

            getWeatherResults(){
                return axios.get('api/climate/' + this.city)
            },

            onSubmit (e) {
                this.saveWeatherResult()
            },

            saveWeatherResult() {
                if(this.city != ''){
                    this.isLoading=true;
                    this.req_status = 'PENDING'
                    let user_data = this.getUserData()
                    axios.post('api/users', user_data)  //first to create users
                    .then(response => {
                        console.log('user created' + response.data)
                        axios.post('api/climate', response.data)//then realations
                        .then(response => {
                            this.req_status = 'OK'
                            this.isLoading=false;
                            this.$swal('Datos guardados correctamente!!!');
                        })
                        .catch(err =>{
                            this.req_status = 'ERROR'
                            this.error_message = 'Error: Failed to submit data.'
                            this.$swal.fire({
                                title: "Error al guardar los datos",
                                icon: 'warning',
                                cancelButtonText: "Cancelar",
                            });
                            this.isLoading=false;
                        })
                    })


            } else {
                this.$swal.fire({
                    title: "Por favor seleccione una ciudad",
                    icon: 'warning',
                    cancelButtonText: "Cancelar",
                });
            }},

            getUserData() {
                let form_data = new FormData()
                form_data.append('city', this.city)
                return form_data
            },
        },
      computed: {}
  }
  </script>

  <style scoped>
  .table-responsive {
      margin-top: 20px;
  }
  .has-error {
      border: thin solid purple
  }
  input, select {
      border-radius: none;
      border: thin solid lightslategray
  }
  #mapContainer {
    width: 40vw;
    height: 40vh;
  }
  .boton_diseno {
    color: #fff;
    background-color: #5cb85c;
    border-color: #4cae4c;
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
  }
  .consultar{
    text-align: center;
  }
  </style>
