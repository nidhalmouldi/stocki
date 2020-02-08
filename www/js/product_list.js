$(document).ready( function () {
    	//$('#table_id').DataTable();

    $('#table_id').DataTable( {
    	"footerCallback": function ( row, data, start, end, display ) {
    		totalPrixAchat = this.api()
    				.column(6, {search:'applied'})
    				.data()
    				.reduce( function (a, b) {
                    return parseInt(a) + parseInt(b);
                	}, 0 );
            $( this.api().column( 6 ).footer() ).html(totalPrixAchat);

            totalPrixVente = this.api()
    				.column(7, {search:'applied'})
    				.data()
    				.reduce( function (a, b) {
                    return parseInt(a) + parseInt(b);
                	}, 0 );
            $( this.api().column( 7 ).footer() ).html(totalPrixVente);

            totalQantite = this.api()
    				.column(2, {search:'applied'})
    				.data()
    				.reduce( function (a, b) {
                    return parseInt(a) + parseInt(b);
                	}, 0 );
            $( this.api().column( 2 ).footer() ).html(totalQantite);

            totalQantiteRestante = this.api()
    				.column(1, {search:'applied'})
    				.data()
    				.reduce( function (a, b) {
                    return parseInt(a) + parseInt(b);
                	}, 0 );
            $( this.api().column( 1 ).footer() ).html(totalQantiteRestante);
            
    	}
    } );
});