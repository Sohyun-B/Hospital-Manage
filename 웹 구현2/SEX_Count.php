<HTML>
    <HEAD>
        <TITLE>성별 count</TITLE>
    </HEAD>

    <BODY>
        <?php
        $conn = mysqli_connect("localhost", "rose", "pRosery20!", "my_db");
        if (!$conn) {
            echo "Database connection error";
        } else {
            echo "Database connection success";
        }

        if (mysqli_connect_errno()) {
            echo "Could not connect: " . mysqli_connect_error();
            exit();
        }

        $query = "SELECT P.SEX, COUNT(P.NAME) 
            FROM PATIENT P
            GROUP BY P.SEX";

        $result = mysqli_query($conn, $query);
        ?>

        <TABLE BORDER=1>
            <TR>
                <TD>성별</TD>
                <TD>환자수</TD>
            </TR>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <TR>
                    <TD><?php echo $row['SEX']; ?></TD>
                    <TD><?php echo $row['COUNT(P.NAME)']; ?></TD>
                </TR>
            <?php } ?>
        </TABLE>

        <?php
        mysqli_free_result($result);
        mysqli_close($conn);
        ?>
    </BODY>
</HTML>
