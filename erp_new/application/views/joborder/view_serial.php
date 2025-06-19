<html>
    <head>
        <title>&nbsp;</title>
        <style>
            *{
                font-size:11px;
            }
            body {
                font-family:sans-serif;
                padding:0px;
                font-size:11px;
                margin:2px;
            }
            div.b128{
                border-left: 2px black solid;
                height: 60px;
                padding: 0px;
            }
            @media print {
                .page-break {page-break-before: always; }
            }
        </style>
    </head>
    <body>
        <table width="750" align="center" border="0">
            <?php
            echo "<tr valign='top'>";
            $counter = 0;
            $counter2 = 0;
            foreach ($job_item_serial as $result) {
                if ($counter == 3) {
                    if ($counter2 == 6) {
                        echo "</tr><tr valign='top' class='page-break'>";
                        $counter2 = 0;
                    } else {
                        echo "</tr><tr valign='top'>";
                    }
                    $counter = 0;
                }
                echo "<td align='center' style='padding:50px 1px 1px 1px;'>";
                //echo $this->model_joborder->bar128($result->serial);
                //echo "" . $result->serial;
                $this->load->view('joborder/routing_card', $result);
                echo "</td>";
                $counter++;
                $counter2++;
            }
            echo "</tr>";
            ?>
        </table>
    </body>
</html>
