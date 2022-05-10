<?php
    //Create attraction link
    $attractionLink = "attraction.php?attractionID=" . $row["AttractionID"];
    //Get Image
    $imageDir = __DIR__ . "/" . $row["AlbumAddress"] . "/";
    $thumbnail = glob($row["AlbumAddress"] . "/Thumbnail.jpg");
    if (count($thumbnail) == 0) {
        $thumbnail = "Resources/Icons/DefaultThumbnail.jpg";
    }
    else {
        $thumbnail = $thumbnail[0];
    }
    ?>
<div class="col-12 col-sm-12 col-md-12 col-lg-6">
    <a class="cityAttractionLink" href=<?= $attractionLink;?>>
        <div class="cityAttraction">
            <div class="row">
                <div class="col-6 col-sm-6 col-md-5 col-lg-5 col-xl-4">
                    <img src=<?= $thumbnail;?> class="cityAttractionImage">
                </div>
                <div class="col-6 col-sm-6 col-md-7 col-lg-7 col-xl-8">
                        <span class="cityAttractionTitle">
                            <?= $row["Name"];?>
                        </span>
                    <br>
                    <span class="cityAttractionBlurb">
                            <?= $row["Description"];?>
                        </span>
                </div>
            </div>
        </div>
    </a>
</div>
