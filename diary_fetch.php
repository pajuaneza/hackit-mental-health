<?php
include_once("./class/Diary.php");

$diary = new Diary();
$diaryUser = new User();
$diaryUser->setId($_REQUEST['u']);
$diary->loadUserData($diaryUser);

if (!empty($diary->getEntries()))
{
    foreach ($diary->getEntries() as $diaryEntry)
    {
        $content = nl2br($diaryEntry->getContent());
        $date = $diaryEntry->getDateCreated()->format("F j, Y (h:i a)");

        echo <<<HTML
            <div style="margin-bottom: 14px;">
                <div>{$content}</div>
                <div class="text-overline">{$date}</div>
            </div>
        HTML;
    }
}
else
{
    echo <<<HTML
        <div>You have no diary entries. Now's the perfect time to make one!</div>
    HTML;
}