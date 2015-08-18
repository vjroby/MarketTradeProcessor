var app = {
    SOCKET_PORT:8890,
    APP_URL:"",

    getMessages: function getMessages(){

        var that = this;
        that.loadOn();
        $.ajax({
            url: this.APP_URL + "/message",
            dataType:"json",
            error: function(error){
                this.loadOff();
            },
            success:function(data){
                that.loadMessagesToTable(data);
                that.loadOff();
            }

        });

    },

    setAppUrl: function setAppUrl(url){
        this.APP_URL = url;
    },

    getAppUrl: function getAppUrl(){
        return this.APP_URL;
    },
    loadMessagesToTable:function(data){
        if (data.length == 0){
            this.addNewInfo('There are no messages in the database');
        }
        for(var i= 0 ; data.length > i ; i++){

            $(".messages-table > tbody").prepend('<tr>' +
                '<td>'+data[i].id+'</td>'+
                '<td>'+data[i].userId+'</td>'+
                '<td>'+data[i].currencyFrom+'</td>'+
                '<td>'+data[i].currencyTo+'</td>'+
                '<td>'+data[i].amountSell+'</td>'+
                '<td>'+data[i].amountBuy+'</td>'+
                '<td>'+data[i].rate+'</td>'+
                '<td>'+data[i].timePlaced+'</td>'+
                '<td>'+data[i].originatingCountry+'</td>'+
                '</tr>')
        }
    },
    loadOn: function loadOn(){
        $(".load-bar").removeClass("hidden");
    },
    loadOff: function loadOff(){
        $(".load-bar").addClass("hidden");
    },
    getSocketUrlAndHost: function getSocketUrlAndHost(){
        return this.APP_URL+":"+this.SOCKET_PORT;
    },

    addNewInfo: function addNewInfo(text){
        var alert = $(".alert");

        if (alert.length !=0){
            alert.each(function(){
                this.remove();
            });
        }

        var htlm = '<div class="alert alert-info alert-dismissible fade in" role="alert">' +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
            '<span aria-hidden="true">×</span>' +
            '</button>'+text+'</div>';

        $('.panel').append(htlm);
    },

};
