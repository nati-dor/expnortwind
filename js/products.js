var products = function() {

    let productsArr = [];

    async function getProductsWithFillter(categoryId, supplierId) {
        let action    = 'getProductsWithFillter';
        let data      = {'categoryId' : categoryId, 'supplierId': supplierId};
        await nanoajax.ajax({url: `rpc/products.rpc.php?action=`+ action, method: 'POST', body: JSON.stringify(data)}, function(code, responseText) {
            try {
                const result = JSON.parse(responseText);
                if(result.response) { 
                    productsArr = result.response;
                    buildTbodyProducts();
                } else {
                    let massage = result.response.error ? result.response.error : "Something wrong happened";
                    new swal("Ohh no!", `${massage}!`, "warning");
                }
            } catch(err) {
                console.log(err);
            }
        })
    }

    async function buildTbodyProducts() {
        let searchProducts        = $$('id-search-products').value.toLowerCase();
        let strTbody              = '';
        let tbodyProductsEL       = $$('id-tbody-products');
        tbodyProductsEL.innerHTML = strTbody;
        for (let i = 0; i < productsArr.length; i++) {
            let strHidden = '';
            if(!productsArr[i].ProductName.toLowerCase().includes(searchProducts))
                strHidden = 'hidden';
            strTbody += `<tr class="tr-tbody-products" ${strHidden}>
                            <td>${productsArr[i].ProductID}</td>      
                            <td>${productsArr[i].ProductName}</td> 
                            <td>${productsArr[i].CategoryName}</td> 
                            <td>${productsArr[i].CompanyName}</td> 
                            <td>${productsArr[i].QuantityPerUnit}</td> 
                            <td>${productsArr[i].UnitPrice}</td> 
                            <td>${productsArr[i].UnitsInStock}</td> 
                            <td>${productsArr[i].UnitsOnOrder}</td> 
                            <td>${productsArr[i].ReorderLevel}</td> 
                            <td>${productsArr[i].Discontinued}</td> 
                         </tr>`;
        }
        tbodyProductsEL.innerHTML = strTbody;
    }



    async function fillterTable(event) {
        event.preventDefault();
        let formFillterProducts = $$("id-form-products");
        let categories          = formFillterProducts.categories.value;
        let suppliers           = formFillterProducts.suppliers.value;
        getProductsWithFillter(categories, suppliers);
    }

    
    return {
        getProductsWithFillter,
        fillterTable,
        buildTbodyProducts
    }
    }();