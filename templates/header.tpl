<table width="100%"  bgcolor="#708090" >
                        <tr >
                            <td width="70%" height="70" align="center">
                                <h2>Автоматическая система тестирования</h2>
                            </td>
                            <td width="10%" height="70">
                                <table>
                                        {if $name_page!='quiz'}
                                        <tr>
                                            <td>
                                                <a href='quiz.php'>Стать тестируемым</a>
                                            </td>
                                        </tr>
                                        {/if}
                                        {if $role_user>=2}
                                            {if $name_page!='create_test'}
                                            <tr>
                                                <td>
                                                    <a href='create.php'>Стать автором тестов</a>
                                                </td>
                                            </tr>
                                            {/if}
                                            {if $role_user==3}
                                                {if $name_page!='administration'}
                                                <tr>
                                                    <td>
                                                        <a href='administration.php'>Стать администратором</a>
                                                    </td>
                                                </tr>
                                                {/if}
                                            {/if}    
                                        {/if}
                                </table>
                            </td>
                            <td width="15%" height="70">
                                {$you}
                            </td>
                            <td width="5%" height="70">
                                <a href='{$name_page}.php?link_click=exit'>Выход</a>
                            </td>
                        </tr>
                    </table>                           
        