$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});

function updateCartDropdown() {
    $.get('/cart/dropdown', function(res) {
        if(res.status === 'success') {
            $('.cart-dropdown').replaceWith(res.cartHtml);
        }
    });
}



$(document).on('click', '.btn-cart', function () {

     
    if ($(this).hasClass('disable')) {
        e.preventDefault();
        return false;
    }

    let productId = $(this).data('id');
    let quantity = $(this).closest('.details-filter-row').find('input[name="quantity"]').val();
    $.ajax({
        url: '/cart',
        method: "POST",
        data: {
            product_id: productId,
            quantity: quantity
        },
        success: function (res) {
           
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: res.message,
                showConfirmButton: false,
                timer: 3000,
            });
            updateCartDropdown();
           
        },
        error: function () {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: res.message,
                showConfirmButton: false,
                timer: 3000,
            });
        }
    });

});

$(document).on('click', '.btn-remove-cart', function () {

    let id = $(this).data('id');
    let row = $(this).closest('tr');
    

    $.ajax({
        url: "/cart/remove/" + id,
        method: "POST",
        data: {
            _method: "DELETE"
        },
          success: function (res) {
    if(res.status === 'success'){
        // Update the dropdown cart
        $('.cart-dropdown').replaceWith(res.cartHtml);

        // Remove row from cart page if exists
        if(row.length){
            row.remove();
            $('.cart-total-price').text('$' + res.total);
        }

        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: res.message,
            showConfirmButton: false,
            timer: 2000
        });
    }
},
        error: function () {
                        Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: res.message,
                        showConfirmButton: false,
                        timer: 3000,
                    });
                   
                  
        }
    });
});
$(document).on('change', '.btn-quantity', function () {

    let input = $(this);
    let id = input.data('id');
    let quantity = input.val();
    let row = input.closest('tr');

    $.ajax({
        url: "/cart/update/" + id,
        method: "POST",
        data: {
            _method: "PUT",
            quantity: quantity
        },
        success: function (res) {

            // تحديث total بتاع الصف
            row.find('.total-col').text('$' + res.item_total);

            // // تحديث total الكلي
            // $('.summary-total td:last').text('$' + res.cart_total);

            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: res.message,
                showConfirmButton: false,
                timer: 2000,
            });
        },
        error: function (res) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: res.message,
                showConfirmButton: false,
                timer: 2000,
            });
        }
    });
});

 $(document).on('click','.btn-wishlist',function(){
    let productId = $(this).data('id');

    $.ajax({
        url: '/wishlist',
        method: "POST",
        data: {
           
            product_id: productId
        },
        success: function (res) {
           
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: res.message,
                showConfirmButton: false,
                timer: 3000,
            });
        },
        error: function () {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: res.message,
                showConfirmButton: false,
                timer: 3000,
            });
        }
    });


    
});
$(document).on('click', '.btn-remove-wishlist', function () {

    let id = $(this).data('id');
    let row = $(this).closest('tr');

    $.ajax({
        url: "/wishlist/remove/" + id,
        method: "POST",
        data: {
            _method: "DELETE"
        },
        success: function () {
            row.remove(); 
        },
        error: function () {
                        Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: res.message,
                        showConfirmButton: false,
                        timer: 3000,
                    });
        }
    });
});


let timer;

$(document).on('keyup', '.input-search', function () {

    clearTimeout(timer);

    let search = $(this).val();

    timer = setTimeout(() => {

        // ✅ لو فاضي يرجع المنتجات الأصلية (اختياري)
        if (search.length < 2) {
            location.reload(); // أو تخليها فاضية لو مش عايز reload
            return;
        }

        $.ajax({
            url: '/search',
            method: "GET",
            data: { search },

            success: function (res) {

                // ✅ امسح القديم مرة واحدة بس
                $('.product-card').html('');

                // ✅ لو مفيش نتائج
                if (res.length === 0) {
                    $('.product-card').html(`
                        <div class="col-12 text-center">
                            <h4>No products found</h4>
                        </div>
                    `);
                    return;
                }

                // ✅ عرض النتائج
                res.forEach(product => {

                    let image = product.image 
                        ? `/storage/${product.image}` 
                        : `/assets/images/default-product.jpg`;

                    let secondImage = product.second_image 
                        ? `<img src="/storage/${product.second_image}" class="product-image-hover">`
                        : '';

                    let oldPrice = product.price > product.sale_price
                        ? `<span class="discount-price">$${product.price}</span>`
                        : '';

                    let categoryName = product.category 
                        ? product.category.name 
                        : 'No Category';

                    $('.product-card').append(`
                        <div class="col-6 col-md-4 col-lg-3 col-xl-5col">

                            <div class="product product-11 text-center">

                                <figure class="product-media">
                                    <a href="/product/${product.slug}">
                                        <img src="${image}" class="product-image">
                                        ${secondImage}
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="javascript:;" 
                                           data-id="${product.id}"
                                           class="btn-product-icon btn-wishlist">
                                            <span>Add to Wishlist</span>
                                        </a>
                                    </div>
                                </figure>

                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="#">${categoryName}</a>
                                    </div>

                                    <h3 class="product-title">
                                        <a href="/product/${product.slug}">
                                            ${product.name}
                                        </a>
                                    </h3>

                                    <div class="product-price">
                                        $${product.sale_price}
                                        ${oldPrice}
                                    </div>
                                </div>

                                <div class="product-action">
                                    <a href="javascript:;" 
                                       data-id="${product.id}"
                                       class="btn-product btn-cart">
                                        <span>add to cart</span>
                                    </a>
                                </div>

                            </div>

                        </div>
                    `);

                });

            }
        });

    }, 300);

});


 $(document).on('submit', '#checkout-form', function (e) {

        e.preventDefault();

        let btn = $('#place-order-btn');
        btn.prop('disabled', true).text('Processing...');

        $.ajax({
            url: '/checkout',
            method: "POST",
            data: $(this).serialize(),
            success: function (response) {

           
                Swal.fire({
                    icon: 'success',
                    title: response.message,
                    confirmButtonText: 'OK'
                });

                // ✅ empty form
                $('#checkout-form')[0].reset();

                // ✅ clear order summary
                $('.table-summary tbody').html(`
                    <tr>
                        <td colspan="2">Cart is empty</td>
                    </tr>
                `);

                // ✅ reset total
                $('.table-summary tbody').html(`
                    <tr>
                        <td colspan="2">Cart is empty</td>
                    </tr>
                    <tr class="summary-total">
                        <td>Total:</td>
                        <td>$0</td>
                    </tr>
                `);

            },
            error: function (xhr) {

                btn.prop('disabled', false).text('Place Order');

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let msg = '';

                    $.each(errors, function (key, value) {
                        msg += value[0] + '\n';
                    });

                    alert(msg);
                } else {
                    alert('Something went wrong!');
                }
            }
        });

    });



