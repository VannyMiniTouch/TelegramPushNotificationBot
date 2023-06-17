<style>
    .HomePage {
        width: 100dvw;
        height: 100dvh;
    }

    .container-header h3 {
        text-align: center;
    }

    .CreateAndSend_allUsers {
        text-align: right;
    }

    .tableList-Users-container>table {
        text-align: center;
    }

    .form-group {
        width: 100%;
    }

    .blockUrl {
        width: 100%;
    }

    .dfr-r {
        display: flex;
        flex-direction: row;
        align-content: center;
        justify-content: flex-end;
        align-items: center;
    }

    .dfr-c {
        display: flex;
        gap: 1rem;
        flex-direction: row;
        flex-wrap: nowrap;
        align-content: center;
        justify-content: center;
        align-items: center;
    }

    .preImg {
        display: none;
    }
</style>

<div class="HomePage">
    <div class="container">
        <div class="container-header mt-3">
            <div class="welcome">
                <h3>Welcome To BOT ADMIN</h3>
            </div>

        </div>
        <div class="container-body">
            <div class="tableList-Users-container">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="20%" scope="col">#</th>
                            <th width="60%" scope="col">ID</th>
                            <th width="20%" scope="col">
                                <button class="btn btn-sm btn-primary CreateAndSend_allUsers" type="button" title="Create Notification then send all users">Send All</button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT COUNT(*) FROM `mod_telegram_member`";
                        $result = mysqli_query($con, $sql);
                        $row = mysqli_fetch_row($result);
                        $total_records = $row[0];
                        $total_pages = ceil($total_records / 10);

                        if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                            $current_page = (int) $_GET['page'];
                        } else {
                            $current_page = 1;
                        }

                        if ($current_page > $total_pages) {
                            $current_page = $total_pages;
                        } elseif ($current_page < 1) {
                            $current_page = 1;
                        }

                        $offset = ($current_page - 1) * 10;

                        $sql = "SELECT * FROM `mod_telegram_member` ORDER BY `id` DESC LIMIT 10 OFFSET {$offset}";
                        $result = mysqli_query($con, $sql);
                        $assoc = mysqli_fetch_all($result, MYSQLI_ASSOC);

                        foreach ($assoc as $key => $val) {
                        ?>
                            <tr id="<?php echo $key ?>">
                                <th scope="row"><?php echo ($offset + $key + 1) ?></th>
                                <td id="<?php echo $val['user_id'] ?>"><?php echo $val['user_id'] ?></td>
                                <td>
                                    <button class="btn btn-sm btn-primary selectThisUser" userid="<?php echo $val['user_id'] ?>" type="button">Send</button>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <div aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php if ($current_page > 1) : ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo ($current_page - 1) ?>">Previous</a></li>
                        <?php endif; ?>

                        <?php for ($i = max(1, min($total_pages - 6, $current_page - 2)); $i <= min(max(7, $current_page + 4), $total_pages); ++$i) : ?>
                            <?php if ($i == max(1, min($total_pages - 6, $current_page - 2))) : ?>
                                <li class="page-item"><a class="page-link" href="?page=1">1</a></li>
                                <?php if ($i > 2) : ?>
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if ($i == min(max(7, $current_page + 4), $total_pages)) : ?>
                                <?php if ($i < ($total_pages - 1)) : ?>
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                <?php endif; ?>
                                <li class="page-item"><a class="page-link" href="?page=<?php echo $total_pages ?>"><?php echo $total_pages ?></a></li>
                            <?php endif; ?>

                            <?php if (($i != max(1, min($total_pages - 6, $current_page - 2))) && ($i != min(max(7, $current_page + 4), $total_pages))) : ?>
                                <?php if ($i == $current_page) : ?>
                                    <li class="page-item active"><span class="page-link"><?php echo $i ?></span></li>
                                <?php else : ?>
                                    <li class="page-item"><a class="page-link" href="?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endfor; ?>

                        <?php if ($current_page < $total_pages) : ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo ($current_page + 1) ?>">Next</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- =================== Block Modal ================== -->
        <div>
            <div class="modal fade" id="Modal_Create_Message" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">CREATE MESSAGE</h5>
                            <button id="CloseModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body modal_body_create">
                            <form action="javascript:void(0)" id="FormCreateMessage" name="FormCreateMessage" class="FormCreateMessage" method="POST" enctype="multipart/form-data">

                                <div class="form-gruop dfr-c">
                                    <div class="blockUrl">
                                        <label for="">URL Images</label>
                                        <input type="url" class="form-control" name="sorceImg" id="sourceImg">
                                    </div>
                                    <div class="preImg">
                                        <img id="showImg" src="" alt="">
                                    </div>

                                </div>

                                <div class="form-floating mt-3">
                                    <textarea class="form-control" placeholder="Leave a comment here" id="MessageDesc" style="height: 100px"></textarea>
                                    <label for="">Write Notification</label>
                                </div>

                                <div class="form-group text-right mt-2">
                                    <button class="btn btn-secondary" id="resetForm" type="reset">Reset</button>
                                    <button class="btn btn-primary" id="SendToUser" type="submit">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        // https://s3-ap-northeast-1.amazonaws.com/hcgames.3g/content/images/kg/user/list/2.jpg
        //close Modal 
        $('#CloseModal').click(function() {
            $('#Modal_Create_Message').modal('hide');
        })
        $("#resetForm").click(function() {
            $("#showImg").attr('src', "")
                .closest("div")
                .removeAttr("style")
        })

        //send this user
        $(document).on('click', '.selectThisUser', function() {
            const thisUser = $(this).attr('userid');
            console.log(thisUser, "top")
            $('#Modal_Create_Message').modal('show')
            $('#SendToUser').attr({
                'user-type': 'thisUser',
                'user-id': thisUser
            })
        })

        $("#sourceImg").blur(function() {
            console.log($(this).val())
            if (!$(this).val) {
                $("#showImg").attr('src', "")
                    .closest("div")
                    .removeAttr("style")
            } else {
                const ImageSource = $(this).val();
                $("#showImg").attr('src', ImageSource)
                    .closest("div")
                    .css("display", "block");
            }
        });

        //send this user
        $('#SendToUser').click(function() {
            const userID = $(this).attr('user-id');
            const Img = $('#sourceImg').val();
            const Smg = $('#MessageDesc').val();

            axios.post('http://reactdeployapi/api/test', {
                    firstName: 'Fred',
                    lastName: 'Flintstone'
                })
                .then(function(response) {
                    // console.log(response);
                    const data = response.data;
                    console.log(data)
                })
                .catch(function(error) {
                    console.log(error);
                });
        })


    })
</script>