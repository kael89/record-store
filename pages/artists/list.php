<?php
/*** Program ***/
require_once "{$_SERVER["DOCUMENT_ROOT"]}/record-store/lib/library.php";
requirePhp("view");
$sortBy = getGet("sort");
$artistList = getArtistList();

/*** View ***/
?>
<div class="col-xs-12">
    <?php printArtistList($artistList, $sortBy); ?>
</div>

<?php
/*** Functions ***/
function getArtistList() {
    $artists = getArtistsAll();

    $list = [];
    foreach ($artists as $artist) {
        $list[] = [
            "id" => $artist->getId(),
            "name" => $artist->getName(),
            "artistLink" => viewArtistLink([$artist]),
            "country" => $artist->getCountry(),
            "year" => $artist->getFoundationYear(),
            "records" => count(getRecordsByArtistId($artist->getId()))
        ];
    }

    return $list;
}

function printArtistList($artistList, $sortBy = "") {
    if ($sortBy) {
        usort($artistList, function($a, $b) use ($sortBy) {
            if (!in_array($sortBy, ["price", "records"])) {
                return strcmp($a[$sortBy], $b[$sortBy]);
            } else {
                return (int)$a[$sortBy] - (int)$b[$sortBy];
            }
        });
    }

    echo <<<_END
<table class="table sortlist" data-content="artists">
    <tbody>
        <tr>
            <th></th>
            <th>#</th>
            <th data-sort="artistLink">Name</th>
            <th data-sort="country">Country</th>
            <th data-sort="year">Foundation Year</th>
            <th data-sort="records">Number of Records</th>
        </tr>
_END;

    $i = 1;
    foreach ($artistList as $artist) {
        echo <<<_END
        <tr>
            <td><a class="delete" href="#" title="Delete record" data-id="{$artist["id"]}" data-item="{$artist["name"]}" data-action="delete_artist"><span class="glyphicon glyphicon-remove"></a></td>
            <td>$i</td>
            <td>{$artist["artistLink"]}</td>
            <td>{$artist["country"]}</td>
            <td>{$artist["year"]}</td>
            <td>{$artist["records"]}</td>
        </tr>
_END;
        $i++;  
    }

    echo <<<_END
    </tbody>
</table>
_END;
}
