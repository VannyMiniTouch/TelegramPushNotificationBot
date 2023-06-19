<style>
    .HomePage {
        width: 100dvw;
        height: 100dvh;
    }

    .container-header h3 {
        text-align: center;
    }

    .SendAllUsers {
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

    #CloseModal {
        background: none;
        border: none;
        font-size: large
    }

    .preImg {
        display: none;
    }

    .preImg img {
        width: 100%;
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
                            <th scope="col">#</th>
                            <th scope="col">Tele-ID</th>
                            <th scope="col">User Name</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">
                                <button id="SendAllUsers" class="btn btn-sm btn-primary SendAllUsers" type="button" title="Create Notification then send all users">Send All</button>
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
                                <td id="<?php echo $val['tid'] ?>"><?php echo $val['tid'] ?></td>
                                <td id="<?php echo $val['username'] ?>"><?php echo $val['username'] ?></td>
                                <td id="<?php echo $val['firstname'] ?>"><?php echo $val['firstname'] ?></td>
                                <td id="<?php echo $val['lastname'] ?>"><?php echo $val['lastname'] ?></td>
                                <td>
                                    <button class="btn btn-sm btn-primary selectThisUser" userid="<?php echo $val['tid'] ?>" type="button">Send</button>
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

        // ============== Bot Token ============
        const BOT_Token = "5786700742:AAFOFU8nL8PxXmHp4lNC2z89nm2ugIKdJmI";
        var IsImage = false;

        // iziToast.settings({
        //     timeout: 10000,
        //     resetOnHover: true,
        //     icon: 'material-icons',
        //     transitionIn: 'flipInX',
        //     transitionOut: 'flipOutX',
        //     onOpening: function() {
        //         console.log('callback abriu!');
        //     },
        //     onClosing: function() {
        //         console.log("callback fechou!");
        //     }
        // });

        function iziToastSuccess(title = "Success", smg) {
            iziToast.success({
                title: title,
                message: smg,
                position: 'topRight'
            });
        }

        function iziToastError(title = "Error", smg = "Somethings went wrong") {
            iziToast.error({
                title: title,
                message: smg,
                position: 'topRight'
            });
        }

        //reset form then close modal
        $('#CloseModal').click(function() {
            $("#FormCreateMessage")[0].reset();
            $("#showImg").attr('src', "")
                .closest("div")
                .removeAttr("style")
            $('#Modal_Create_Message').modal('hide');
        })

        //reset form but not close modal
        $("#resetForm").click(function() {
            $("#showImg").attr('src', "")
                .closest("div")
                .removeAttr("style")
        })

        //send this user => open modal and add attribute to button tage
        $(document).on('click', '.selectThisUser', function() {
            const thisUser = $(this).attr('userid');
            $('#Modal_Create_Message').modal('show')
            $('#SendToUser').attr({
                'user-type': 'thisUser',
                'user-id': thisUser
            })
        })

        //send all users => open modal and add attribute to button tage
        $("#SendAllUsers").click(function() {
            $('#Modal_Create_Message').modal('show')
            $('#SendToUser').attr({
                'user-type': 'AllUsers',
                'user-id': true
            })
        })

        //checking Image have or not
        function checkImage(url) {
            return new Promise((resolve, reject) => {
                const img = new Image();
                img.onload = () => resolve(true);
                img.onerror = () => reject(false);
                img.src = url;
            });
        }
        //on leave focus append url to Image src
        $("#sourceImg").blur(function() {
            if ($(this).val() == "") {
                $("#showImg").attr('src', "")
                    .closest("div")
                    .removeAttr("style")
                IsImage = false;
            } else {
                const ImageSource = $(this).val();
                checkImage(ImageSource)
                    // .then( result => console.log(result))
                    .then(function(result) {
                        console.log("res => ", result)
                        if (result) {
                            $("#showImg").attr('src', ImageSource)
                                .closest("div")
                                .css("display", "block");
                            IsImage = false;
                        } else {
                            $("#showImg").attr('src', "")
                                .closest("div")
                                .removeAttr("style")
                            IsImage = true;
                        }
                    })
                    .catch(function(error) {
                        $("#showImg").attr('src', "")
                            .closest("div")
                            .removeAttr("style")
                        iziToastError('Error URL', "Image Url may wrong")
                        IsImage = true;
                        console.log("error=>", error)
                    });
            }
        });




        //   const test =   checkImage('https://s3-ap-northeast-1.amazonaws.com/hcgames.3g/content/images/kg/user/list/23.jpg')
        //   .then(function(res){
        //     console.log("rest =>",res)
        //   }).catch(function(error){
        //     console.log("err ", error)
        //   })
        // .then(result => console.log(result))
        // .catch(error => console.log(error));


        //Function Switch Send Specific User / All Users
        $('#SendToUser').click(function() {
            if (IsImage) {
                iziToastError('Error URL', "Image Url may wrong")
                return;
            }
            const userID = $(this).attr('user-id');
            const Img = $('#sourceImg').val();
            const Smg = $('#MessageDesc').val();
            const Usertype = $(this).attr('user-type')
            if (Usertype == "thisUser") {
                SendThisUser(userID, Img, Smg)
            } else if (Usertype == "AllUsers") {
                SendAllUsers(Img, Smg)
            } else {
                console.log("Usertype not found")
            }
        })

        //Send This User
        function SendThisUser(Userid, Img, Smg) {
            const Smg_EndCode = encodeURIComponent(Smg);
            const SEND_TEXT = `https://api.telegram.org/bot${BOT_Token}/sendMessage?chat_id=${Userid}&photo=${Img}&text=${Smg_EndCode}`;
            const SEND_TEXT_IMAGE = `https://api.telegram.org/bot${BOT_Token}/sendPhoto?chat_id=${Userid}&photo=${Img}&caption=${Smg_EndCode}`;
            axios.get(Img ? SEND_TEXT_IMAGE : SEND_TEXT)
                .then(function(response) {
                    const data = response.data;
                    console.log(response.data)
                    //if success
                    if ('ok' in data) {
                        //call alert success here
                        iziToastSuccess("Success", "Notification was sent")
                        $("#FormCreateMessage")[0].reset();
                        $("#showImg").attr('src', "")
                            .closest("div")
                            .removeAttr("style")
                        $('#Modal_Create_Message').modal('hide');
                    }
                })
                .catch(function(error) {
                    //call alert error
                    iziToastError();
                    console.log(error);
                });
        }
        //Send To All Users
        function SendAllUsers(Img, Smg) {
            let once = true;
            let count_status = 0;
            axios.post("controller/get_all_users.php", {}).then(function(res) {
                console.log("res data",res.data)
                if (res.data) {
                    // console.log("rest data =>",res.data)
                    //Telegram maximume time per send is 350milisecond and maximum message is 30messages per second
                    const delay = (ms) => new Promise((resolve) => setTimeout(resolve, ms));
                    res.data.reduce(
                        (promiseChain, currentTask) =>
                        promiseChain.then(() => delay(400)).then(() => {
                            const Userid = currentTask.tid;
                            const Smg_EndCode = encodeURIComponent(Smg);
                            const SEND_TEXT = `https://api.telegram.org/bot${BOT_Token}/sendMessage?chat_id=${Userid}&photo=${Img}&text=${Smg_EndCode}`;
                            const SEND_TEXT_IMAGE = `https://api.telegram.org/bot${BOT_Token}/sendPhoto?chat_id=${Userid}&photo=${Img}&caption=${Smg_EndCode}`;
                            axios.get(Img ? SEND_TEXT_IMAGE : SEND_TEXT)
                                .then(function(response) {
                                    const data = response.data;
                                    //if success
                                    if ('ok' in data && once) {
                                        //call alert success here
                                        iziToastSuccess("Success", "Notification was sent")
                                        $("#FormCreateMessage")[0].reset();
                                        $("#showImg").attr('src', "")
                                            .closest("div")
                                            .removeAttr("style")
                                        $('#Modal_Create_Message').modal('hide');
                                        once = false;
                                    }
                                })
                                .catch(function(error) {
                                    //call alert error
                                    // iziToastError();
                                    // console.log(error);
                                });
                        }),
                        Promise.resolve()
                    );
                }
            }).catch(function(error) {
                console.log(error)
            })
        }
    })
</script>