<html>
    <head>
        <link rel="stylesheet" href="<?php base_url(); ?>/ci/css/style.css" type="text/css" media="screen" title="no title" charset="utf-8">
        <title>Upload Form</title>


    </head>

    <body>

        <div id"=popupContact">
             <a id="popupContactClose">x</a>
            <p id="contactArea"> 

            <tabel with="260" border="1" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                <onload="cangeScreenSize(200,300)">
                    <h3 align="center">Ladda upp en profilbild</h3>
                    </td>
                    </tr>
                    <tr>
                        <td>
                            </div
                            <div id="backgroundPopup"></div>

                            <!---Ladda upp bild---->
                            <?php echo $error; ?>
                            <?php echo 'Välj en bildfild med filändelsen .jpg, .png eller .gif. Bilden får vara max 1 mb stor och inte större än 1024x768 pixlar'; ?>
                            <?php echo form_open_multipart('upload/do_upload'); ?>

                            <input type="file" name="userfile" size="20" />

                            <br /><br />

                            <input type="submit" value="upload" />
                            </form>
                        </td>
                    </tr>
            </tabel>
    </body>
</html>