(function(){$(function(){
    var vendorFields = 'input[name="shop_name"], input[name="shop_url"], input[name="shop_phone"], input[name="shop_phone_display"]';

    // Switching back to "customer": clear + disable vendor-only data so it is not submitted.
    function syncVendorFields(form) {
        var checked = form.find('input[name="is_vendor"]:checked').val();
        var wrapper = form.find('[data-bb-toggle="vendor-info"]');
        if (checked == 1) {
            wrapper.find(vendorFields).prop('disabled', false);
        } else {
            wrapper.find(vendorFields).val('').prop('disabled', true).removeClass('is-valid is-invalid');
            wrapper.find('.shop-url-status').text('');
        }
    }
    $(document).on('change click', 'input[name="is_vendor"]', function () { syncVendorFields($(this).closest('form')); });
    $('input[name="is_vendor"]').first().closest('form').each(function () { syncVendorFields($(this)); });

    // Shop URL: letters (lower-cased), numbers and hyphens only.
    $(document).on('input', 'input[name="shop_url"]', function () {
        var v = this.value.toLowerCase().replace(/[^a-z0-9-]/g, '');
        if (v !== this.value) { this.value = v; }
    });

    // Phone inputs: digits only, capped (10 for +1 / +91, otherwise 15).
    $(document).on('input', '.js-phone-number-mask[data-country-code-selection="true"]', function () {
        var dial = $(this).closest('.iti').find('.iti__selected-dial-code').text().trim();
        var max = (dial === '+1' || dial === '+91') ? 10 : 15;
        var v = this.value.replace(/\D/g, '').slice(0, max);
        if (v !== this.value) { this.value = v; }
    });
});})();
(function(){$(()=>{if($(document).on("click","input[name=is_vendor]",s=>{const e=$(s.currentTarget);e.val()==1?$('[data-bb-toggle="vendor-info"]').slideDown():($('[data-bb-toggle="vendor-info"]').slideUp(),e.closest("form").find("button[type=submit]").prop("disabled",!1))}),$('form.js-base-form input[name="shop_url"]').on("change",s=>{const e=$(s.currentTarget),t=e.closest("form"),i=e.val();if(!i)return;const a=t.find("[data-slug-value]");$.ajax({url:e.data("url"),type:"POST",data:{url:i,_token:t.find('input[name="_token"]').val()||$('meta[name="csrf-token"]').attr("content")},beforeSend:()=>{e.prop("disabled",!0),t.find("button[type=submit]").prop("disabled",!0)},success:({error:o,message:r,data:n})=>{o?(e.addClass("is-invalid").removeClass("is-valid"),$(".shop-url-status").removeClass("text-success").addClass("text-danger").text(r)):(e.removeClass("is-invalid").addClass("is-valid"),$(".shop-url-status").removeClass("text-danger").addClass("text-success").text(r),t.find("button[type=submit]").prop("disabled",!1)),n!=null&&n.slug&&a.html(`${a.data("base-url")}/<strong>${n.slug.substring(0,100).toLowerCase()}</strong>`)},complete:()=>e.prop("disabled",!1)})}),$(".become-vendor-form").length){let s=null,e=null;$("#certificate-dropzone").length&&(s=new Dropzone("#certificate-dropzone",{url:"#",autoProcessQueue:!1,paramName:"certificate_file",maxFiles:1,acceptedFiles:".pdf,.jpg,.jpeg,.png,.webp",addRemoveLinks:!0,dictDefaultMessage:$("#certificate-dropzone").data("placeholder"),maxfilesexceeded:function(t){this.removeFile(t)}})),$("#government-id-dropzone").length&&(e=new Dropzone("#government-id-dropzone",{url:"#",autoProcessQueue:!1,paramName:"government_id_file",maxFiles:1,acceptedFiles:".pdf,.jpg,.jpeg,.png,.webp",addRemoveLinks:!0,dictDefaultMessage:$("#government-id-dropzone").data("placeholder"),maxfilesexceeded:function(t){this.removeFile(t)}})),$("form.become-vendor-form").on("submit",function(t){t.preventDefault();const i=$(t.currentTarget),a=new FormData(i.get(0));s&&s.getQueuedFiles().length>0&&a.append("certificate_file",s.getQueuedFiles()[0]),e&&e.getQueuedFiles().length>0&&a.append("government_id_file",e.getQueuedFiles()[0]),$.ajax({url:i.prop("action"),type:"POST",data:a,processData:!1,contentType:!1,success:function({data:o}){o!=null&&o.redirect_url&&(window.location.href=o.redirect_url)},error:function(o){const{errors:r}=o.responseJSON;i.find("input").removeClass("is-invalid").removeClass("is-valid"),i.find(".invalid-feedback").remove(),r&&Object.keys(r).forEach(n=>{const l=i.find(`input[name="${n}"]`),d=r[n];if(["certificate_file","government_id_file"].includes(n)){const c=i.find(`[data-field-name="${n}"]`);c.find(".invalid-feedback").remove(),c.append(`<div class="invalid-feedback" style="display: block">${d}</div>`)}else l.addClass("is-invalid").removeClass("is-valid"),l.is(":checkbox")||l.parent().append(`<div class="invalid-feedback">${d}</div>`)})}})})}})})();
