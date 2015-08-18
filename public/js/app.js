var app = {

    APP_URL:"",

    getMessages: function getMessages(){

        var that = this;
        $.ajax({
            url: this.APP_URL + "/message",
            dataType:"json",
            error: function(error){

            },
            success:function(data){
                that.loadMessagesToTable(data);
            }

        });

    },

    setAppUrl: function setAppUrl(url){
        console.log("url set"+url);
        this.APP_URL = url;
    },

    getAppUrl: function getAppUrl(){
        return this.APP_URL;
    },
    loadMessagesToTable:function(data){
        console.log(data);
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
    loadOn: function(){

    },
    //http://codepen.io/WhiteWolfWizard/pen/emPJYx
    loadOff: function(){

    }
};
