var employee = function() {

    let TotalByCustomerArr = [];

    async function getTotalByCustomer() {
        let action    = 'get_total_by_customer';
        let data      = {};
        await nanoajax.ajax({url: `rpc/employee.rpc.php?action=`+ action, method: 'POST', body: JSON.stringify(data)}, function(code, responseText) {
            try {
                const result = JSON.parse(responseText);
                if(result.response) { 
                    TotalByCustomerArr = result.response;
                    buildTbodyTotalByCustomer();
                } else {
                    let massage = result.response.error ? result.response.error : "Something wrong happened";
                    new swal("Ohh no!", `${massage}!`, "warning");
                }
            } catch(err) {
                console.log(err);
            }
        })
    }

    async function getTotalByEmployee() {
        let action    = 'get_total_by_employee';
        let data      = {};
        await nanoajax.ajax({url: `rpc/employee.rpc.php?action=`+ action, method: 'POST', body: JSON.stringify(data)}, function(code, responseText) {
            try {
                const result = JSON.parse(responseText);
                if(result.response) { 
                    TotalByCustomerArr = result.response;
                    buildTbodyTotalByEmployee();
                } else {
                    let massage = result.response.error ? result.response.error : "Something wrong happened";
                    new swal("Ohh no!", `${massage}!`, "warning");
                }
            } catch(err) {
                console.log(err);
            }
        })
    }

    async function buildTbodyTotalByCustomer() {
        let tbodyOrdersEL       = $$('id-tbody-total-by-customer');
        let strTbody            = '';
        tbodyOrdersEL.innerHTML = strTbody;
        for (let i = 0; i < TotalByCustomerArr.length; i++) {
            strTbody += `<tr>
                            <td>${TotalByCustomerArr[i].OrderID}</td>      
                            <td>${TotalByCustomerArr[i].total}</td> 
                            <td>${TotalByCustomerArr[i].CustomerID}</td> 
                            <td>${TotalByCustomerArr[i].EmployeeID}</td> 
                         </tr>`;
        }
        tbodyOrdersEL.innerHTML = strTbody;
    }

    async function buildTbodyTotalByEmployee() {
        let tbodyOrdersEL       = $$('id-tbody-total-by-customer');
        let strTbody            = '';
        tbodyOrdersEL.innerHTML = strTbody;
        for (let i = 0; i < TotalByCustomerArr.length; i++) {
            strTbody += `<tr>
                            <td>${TotalByCustomerArr[i].EmployeeID}</td>      
                            <td>${TotalByCustomerArr[i].total}</td> 
                         </tr>`;
        }
        tbodyOrdersEL.innerHTML = strTbody;
    }
    
    return {
        getTotalByCustomer,
        getTotalByEmployee
    }
    }();