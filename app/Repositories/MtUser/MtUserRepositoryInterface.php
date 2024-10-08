<?php
namespace App\Repositories\MtUser;

interface MtUserRepositoryInterface
{
	/* ユーザ情報取得(ユーザID指定) */
    public function getUserInfo(string $userId);

	/* ログイン */
    public function login(array $params);
}
