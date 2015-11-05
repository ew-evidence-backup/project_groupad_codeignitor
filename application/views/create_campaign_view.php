<html>
     <head>

     </head>
     <body>
          <form action="<? $_SERVER['PHP_SELF'] ?>" method="POST">
               <table>
                    <tr>
                         <td>
                              <h1>Create Campaign</h1>
                         </td>
                    </tr>
                    <tr>
                         <td>
                              <label for="offer_name">Campaign Name</label>
                              <input id="offer_name" type="text" name="offer_name">
                         </td>
                    </tr>
                    <tr>
                         <td>
                              <label for="exp_date">Exp Date</label>
                              <input id="exp_date" type="text" name="exp_date">
                         </td>
                    </tr>
                    <tr>
                         <td>
                              <label for="preview_url">Preview URL</label>
                              <input id="preview_url" type="text" name="preview_url">
                         </td>
                    </tr>
                    <tr>
                         <td>
                              <label for="offer_url">Campaign URL</label>
                              <input id="offer_url" type="text" name="offer_url">
                         </td>
                    </tr>
                    <tr>
                         <td>
                              <label for="description">Description</label>
                              <input id="description" type="text" name="description">
                         </td>
                    </tr>
                    <tr>
                         <td>
                              <label for="protocol">Protocol</label>
                              <input id="protocol" type="text" name="protocol">
                         </td>
                    </tr>
                    <tr>
                         <td>
                              <label for="status">Status</label>
                              <input id="status" type="text" name="status">
                         </td>
                    </tr>
                    <tr>
                         <td>
                              <label for="advertiser_id">Advertiser_id</label>
                              <input id="advertiser_id" type="text" name="advertiser_id">
                         </td>
                    </tr>
                    <tr>
                         <td>
                              <input type="SUBMIT" value="Create">
                         </td>
                    </tr>
               </table>
          </form>
     </body>
</html>