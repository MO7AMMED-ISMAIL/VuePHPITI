<template>
    <div class="container">
        <div class="row">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>image</th>
                        <th>Avaliable</th>
                        <th>Control</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(product, rowIndex) in products" :key="rowIndex">
                        <td>{{++rowIndex}}</td>
                        <td>{{product.name}}</td>
                        <td>{{product.category_id}}</td>
                        <td>{{product.price}}</td>
                        <td>{{product.image}}</td>
                        <td>{{product.available}}</td>
                        <td>
                            <button class="btn btn-primary m-1">Edit</button>
                            <button class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import { useProduct } from "@/stores/productStore";
    export default{
        data() {
            return {
                products:[],
            }
        },
        async created() {
            const product = useProduct();
            let pro = await product.allProduct();
            console.log(pro);
            this.products.push(...pro);
        },
    }
</script>