var requestUtils = {
    showProgress: true,
    showError: true,
    // url: 'http://api.boleto.licitanet.com.br/',
    url: 'http://localhost:8000/students',

    doPost: function (path, dataItens, callback) {
        let token = localStorage.getItem('token');
        loading();
        $.ajax({
            type: "POST",
            dataType: "json",
            contentType: 'application/json',
            headers: {
                token: token
            },
            url: requestUtils.url + path,
            data: JSON.stringify(dataItens),
            statusCode: {

                201: callback,
                401: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Não Autorizado!'
                    })
                }
            },
        })

    },
    doGet: function (path, callback, data = {}) {
        loading();
        $.ajax
            ({
                type: "GET",
                dataType: 'json',
                method: "GET",
                // dataType: 'JSON',
                // contentType: 'application/json',
                // data: JSON.stringify(data),
                data: data,
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem('token')
                },
                // processData: true,  // tell jQuery not to process the data
                // contentType: false,  // tell jQuery not to set contentType
                url: requestUtils.url + path,
                statusCode: {
                    //TODO validar tratamento dos códigos de erro
                    200: callback,
                    401: function () {
                        window.location.href = '/login.html'
                    },
                    500: function (error) {
                        if (requestUtils.showError) {

                        }
                    }
                },
            });

    },
    doPostFile: function (path, dataItens, callback) {
        loading();
        $.ajax({
            url: requestUtils.url + path,
            type: "POST",
            // dataType: 'json',
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('token')
            },
            data: dataItens,
            processData: false,
            contentType: false,
            statusCode: {
                //TODO validar tratamento dos códigos de erro
                200: callback,
                400: function () {
                    if (requestUtils.showError) {

                    }
                },
                500: function (error) {
                    console.log('9');
                }
            },
        });
    },
    doPut: function (path, dataItens, callback) {
        $.ajax({
            type: "PUT",
            dataType: 'JSON',
            contentType: 'application/json',
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('token')
            },
            url: requestUtils.url + path,
            data: JSON.stringify(dataItens),
            async: false, //Uma requisicao por vez
            statusCode: {
                //TODO validar tratamento dos códigos de erro
                204: callback,
                200: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Ambos campos devem ser preenchidos'
                    })

                }
            }
        });
    }
};
function loading() {
    if (requestUtils.showProgress) {
        Swal.fire({
            title: 'Processando ...',
            timerProgressBar: true,
            onBeforeOpen: () => {
                Swal.showLoading()
            }
        });
    }
}
