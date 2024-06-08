var orders = function() {

    let ordersArr = [];

    async function getOrdersCustomer() {
        let action    = 'getOrdersCustomer';
        let data      = {};
        await nanoajax.ajax({url: `rpc/orders.rpc.php?action=`+ action, method: 'POST', body: JSON.stringify(data)}, function(code, responseText) {
            try {
                const result = JSON.parse(responseText);
                if(result.response) { 
                    ordersArr = result.response;
                    buildTbodyOrders();
                } else {
                    let massage = result.response.error ? result.response.error : "Something wrong happened";
                    new swal("Ohh no!", `${massage}!`, "warning");
                }
            } catch(err) {
                console.log(err);
            }
        })
    }

    async function buildTbodyOrders() {
        let tbodyOrdersEL       = $$('id-tbody-orders');
        let strTbody            = '';
        tbodyOrdersEL.innerHTML = strTbody;
        for (let i = 0; i < ordersArr.length; i++) {
            strTbody += `<tr>
                            <td>${ordersArr[i].OrderID}</td>      
                            <td>${ordersArr[i].CustomerID}</td> 
                            <td>${ordersArr[i].FirstName} ${ordersArr[i].LastName}</td> 
                            <td>${ordersArr[i].OrderDate}</td> 
                            <td>${ordersArr[i].RequiredDate}</td> 
                            <td>${ordersArr[i].Freight}</td> 
                            <td>${ordersArr[i].ShipName}</td> 
                            <td>${ordersArr[i].ShipAddress}</td> 
                            <td>${ordersArr[i].ShipCity}</td> 
                            <td>${ordersArr[i].ShipCountry}</td> 
                         </tr>`;
        }
        tbodyOrdersEL.innerHTML = strTbody;
    }
    
    return {
        getOrdersCustomer
    }
    }();