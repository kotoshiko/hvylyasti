<?php


// Запуск Цикла WordPress для вывода содержимого страницы
if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		the_content(); // Выводит содержимое страницы, включая шорткоды
	endwhile;
endif;
