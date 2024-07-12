const app = {
    callAjax:  (URL, DATA, FN) => {
        $.ajax(
            {
                type: "POST",
                url: URL,
                data: DATA,
                dataType: "jsonp",
                jsonp: "callback",
                processData: false,
                contentType: false,
                success: (result) => {
                    FN(result);
                }
            }
        )
    }
}