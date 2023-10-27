<div class="container">
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Interdum consectetur libero id faucibus nisl tincidunt eget nullam non. Massa sed elementum tempus egestas sed sed risus pretium quam. Sapien nec sagittis aliquam malesuada bibendum arcu. Risus commodo viverra maecenas accumsan lacus. Mattis ullamcorper velit sed ullamcorper morbi. Laoreet non curabitur gravida arcu ac tortor dignissim convallis aenean. Nec dui nunc mattis enim ut tellus. Platea dictumst quisque sagittis purus sit amet volutpat consequat. Amet consectetur adipiscing elit duis. Fames ac turpis egestas integer. Pharetra magna ac placerat vestibulum lectus mauris ultrices eros in. Suspendisse potenti nullam ac tortor vitae purus faucibus ornare. Ultricies mi quis hendrerit dolor magna eget est. Id faucibus nisl tincidunt eget nullam non nisi. Facilisi etiam dignissim diam quis. Tempus iaculis urna id volutpat lacus laoreet.

        Consectetur a erat nam at lectus urna duis. Platea dictumst vestibulum rhoncus est. Gravida rutrum quisque non tellus orci ac auctor. Tempor orci eu lobortis elementum nibh tellus molestie nunc. Metus dictum at tempor commodo ullamcorper. Enim sit amet venenatis urna cursus. Nisi scelerisque eu ultrices vitae auctor. Suscipit tellus mauris a diam. In fermentum posuere urna nec. Sit amet consectetur adipiscing elit ut aliquam purus sit amet. Pellentesque pulvinar pellentesque habitant morbi tristique. Eget nulla facilisi etiam dignissim diam quis. Sit amet commodo nulla facilisi. Lacus viverra vitae congue eu consequat ac felis.
        
        Tempus egestas sed sed risus pretium. Nec dui nunc mattis enim ut tellus elementum sagittis vitae. Iaculis nunc sed augue lacus viverra vitae congue. Neque gravida in fermentum et. Mauris in aliquam sem fringilla ut. Rutrum tellus pellentesque eu tincidunt tortor aliquam nulla facilisi. Eu non diam phasellus vestibulum lorem sed risus ultricies. Ut morbi tincidunt augue interdum velit euismod. Leo a diam sollicitudin tempor id eu nisl nunc mi. Condimentum mattis pellentesque id nibh tortor id. Risus quis varius quam quisque id diam vel. Consectetur adipiscing elit duis tristique sollicitudin. Purus in massa tempor nec feugiat nisl pretium fusce. Eros in cursus turpis massa tincidunt dui. Enim nulla aliquet porttitor lacus luctus accumsan. A scelerisque purus semper eget duis at tellus. Ullamcorper malesuada proin libero nunc consequat interdum varius. In fermentum posuere urna nec tincidunt. Vitae purus faucibus ornare suspendisse sed nisi lacus sed viverra.
        
        Commodo elit at imperdiet dui accumsan sit. Duis ultricies lacus sed turpis tincidunt id aliquet risus feugiat. Mollis nunc sed id semper risus in hendrerit. Sit amet nulla facilisi morbi tempus iaculis urna. Ut tortor pretium viverra suspendisse. Elementum curabitur vitae nunc sed velit dignissim sodales ut. Mauris in aliquam sem fringilla ut. Eu nisl nunc mi ipsum faucibus vitae aliquet nec. Faucibus nisl tincidunt eget nullam non nisi est. Est lorem ipsum dolor sit amet consectetur adipiscing elit pellentesque. Tellus in hac habitasse platea dictumst vestibulum rhoncus.
        
        Malesuada bibendum arcu vitae elementum curabitur vitae nunc. Sit amet mattis vulputate enim nulla aliquet porttitor. Velit ut tortor pretium viverra suspendisse potenti nullam. Ut diam quam nulla porttitor massa id. Posuere morbi leo urna molestie at. In iaculis nunc sed augue lacus viverra. Consectetur libero id faucibus nisl tincidunt eget nullam non. Amet mauris commodo quis imperdiet massa tincidunt nunc. Ullamcorper dignissim cras tincidunt lobortis feugiat vivamus at augue eget. Turpis egestas pretium aenean pharetra. Sollicitudin ac orci phasellus egestas tellus rutrum. Id consectetur purus ut faucibus pulvinar elementum integer enim neque. Gravida neque convallis a cras semper auctor neque vitae. Faucibus scelerisque eleifend donec pretium vulputate. Urna id volutpat lacus laoreet.</p>

</div>

<style>
    .task-card{
        display: flex;
        flex-wrap: wrap;
        width: 400px;
        min-height: 220px;
        margin-top: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        padding: 12px;
        border-radius: 2%;
        cursor: pointer;

        .task-card-head{
            flex: 100%;
            max-width: 100%;
            display: flex;
            align-items: center;

            p{
                font-weight: bold;
            }
        }

        .task-card-info{
            display: flex;
            gap: 12px;
            margin-top: 20px;

            .task-card-image{
                flex: 30%;
                max-width: 30%;

                img{
                    width: 100%;
                    border-radius: 5%;
                }
            }

            .task-card-body{
                flex: 70%;
                max-width: 70%;

                .task-card-customer{
                    margin-bottom: 20px;
                }

                .task-card-items{
                    display: flex;
                    justify-content: space-between;
                    margin-top: 64px;

                    .task-card-data{
                        display: flex;
                        gap: 12px;
                        align-items: center;
                    }

                    .task-card-created_at{
                        background-color: rgb(61, 61, 61);
                        border: none;
                        color: white;
                        padding: 4px;
                        border-radius: 5%;
                    }

                    .task-card-department{
                        background-color: #e3e3e3;
                        color: #686c71;
                        border: none;
                        padding: 4px;
                        border-radius: 5%;
                        padding: 5px;
                    }

                    .task-card-persons{
                        display: flex;
                        gap: 1px;
                        margin-top: 4px;

                        .task-card-person{
                            height: 20px;
                            width: 20px;
                            border-radius: 50%;
                            background-color: #bbb;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            font-size: 12px;
                            color: white;
                        }
                    }
                }
            }
        }
    }

    .project-card{
        display: flex;
        flex-wrap: wrap;
        width: 400px;
        min-height: 220px;
        margin-top: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        padding: 12px;
        cursor: pointer;
        border-radius: 2%;

        .project-card-head{
            flex: 100%;
            max-width: 100%;
            display: flex;
            align-items: center;

            p{
                font-weight: bold;
            }
        }

        .project-card-info{
            display: flex;
            gap: 12px;
            margin-top: 20px;

            .project-card-image{
                flex: 30%;
                max-width: 30%;

                img{
                    width: 100%;
                    border-radius: 5%;
                }
            }

            .project-card-body{
                flex: 70%;
                max-width: 70%;

                .project-card-customer{
                    margin-bottom: 15px;
                }

                .project-card-items{
                    display: flex;
                    justify-content: space-between;
                    margin-top: 11px;

                    .project-card-data{
                        display: flex;
                        gap: 12px;
                        align-items: center;

                        .project-card-created_at{
                            background-color: rgb(61, 61, 61);
                            border: none;
                            color: white;
                            padding: 4px;
                            border-radius: 5%;
                        }

                        .project-card-department{
                            background-color: #e3e3e3;
                            color: #686c71;
                            border: none;
                            padding: 4px;
                            border-radius: 5%;
                            padding: 5px;
                        }
                    }

                    .project-card-persons{
                        display: flex;
                        gap: 1px;
                        margin-top: 4px;

                        .project-card-person{
                            height: 20px;
                            width: 20px;
                            border-radius: 50%;
                            background-color: #bbb;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            font-size: 12px;
                            color: white;
                        }
                    }
                }
            }
        }
    }

    .dashboard-cards{

        margin-top: 20px;

        .create-customer-card{
            width: 280px;
            height: 130px;
            padding-top: 25px;
            padding-left: 15px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
            background-color: #f8f4f4;

            p{
                margin-top: 10px;
            }

            button{
                margin-top: 10px;
                background-color: gray;
                color: white;
                padding: 4px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
        }
        
        .create-user-card{
            margin-top: 35px;
            width: 280px;
            height: 130px;
            color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            background-color: #807c7c;
            padding-top: 25px;
            padding-left: 15px;

            p{
                margin-top: 10px;
            }

            button{
                margin-top: 10px;
                background-color: black;
                color: white;
                padding: 4px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
        }

        .active-users-card{
            margin-top: 35px;
            width: 280px;
            height: 130px;
            color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            background-color: #90a424;
            padding-top: 25px;
            padding-left: 20px;

            p{
                margin-top: 5px;
            }
        }
    }

    .myProgress{
        margin-top: 53px;
        width: 100%;
        background-color: #f6f6f6;
    }

    .myBar{
        width: 1%;
        height: 10px;
        background-color: #d9d9d9;
    }
</style>