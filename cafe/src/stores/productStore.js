import { defineStore } from 'pinia'

export const useProduct = defineStore('product', {
    state: () => {
        return {
            products: [] 
        }
    },
    
    actions: {
        async allProduct() {
            let productData = await fetch("http://localhost/VuePHP/VuePHPITI/backend/prouduct.php",{
                method: 'GET',
                header:{
                    "content-type": "application/json"
                }
            });
            let data = await productData.json();
            this.products = data;
            return this.products.data;
        },
    },
})